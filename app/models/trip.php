<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trip
 *
 * @author itkoskin
 */
class Trip extends BaseModel {

    static $CLOUDS_TYPES = array(
        'selkeää',
        'melko selkeää',
        'puolipilvistä',
        'melko pilvistä',
        'pilvistä'
    );
    static $WIND_DIRECTIONS = array(
        'pohjoinen',
        'koillinen',
        'itä',
        'kaakko',
        'etelä',
        'lounas',
        'länsi',
        'luode'
    );
    public $id, $player_id, $tripname, $tripday, $start_time, $end_time, $temperature, $water_temperature, $clouds, $wind_mps, $wind_direction, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_tripname', 'validate_tripday', 'validate_start_and_end_time', 'validate_temperatures', 'validate_clouds', 'validate_wind_mps', 'validate_wind_direction', 'validate_description');
    }

    /*
     * CRUD
     */

    private static function selectAttributes($row) {

        return array(
            'id' => $row['id'],
            'player_id' => $row['player_id'],
            'tripname' => $row['tripname'],
            'tripday' => $row['tripday'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'temperature' => $row['temperature'],
            'water_temperature' => $row['water_temperature'],
            'clouds' => $row['clouds'],
            'wind_mps' => $row['wind_mps'],
            'wind_direction' => $row['wind_direction'],
            'description' => $row['description']
        );
    }

    public static function all($id) {
        $query = DB::connection()->prepare('SELECT * FROM Trip WHERE player_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $trips = array();

        foreach ($rows as $row) {
            $trips[] = new Trip(self::selectAttributes($row));
        }

        return $trips;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Trip WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $trip = new Trip(self::selectAttributes($row));

            return $trip;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction, description) VALUES (:player_id, :tripname, :tripday, :start_time, :end_time, :temperature, :water_temperature, :clouds, :wind_mps, :wind_direction, :description) RETURNING id');
        $query->execute(array(
            'player_id' => $this->player_id,
            'tripname' => $this->tripname,
            'tripday' => $this->tripday,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'temperature' => $this->temperature,
            'water_temperature' => $this->water_temperature,
            'clouds' => $this->clouds,
            'wind_mps' => $this->wind_mps,
            'wind_direction' => $this->wind_direction,
            'description' => $this->description));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Trip SET player_id = :player_id, tripname = :tripname, tripday = :tripday, start_time = :start_time, end_time = :end_time, temperature = :temperature, water_temperature = :water_temperature, clouds = :clouds, wind_mps = :wind_mps, wind_direction = :wind_direction, description = :description WHERE id = :id');
        $query->execute(array(
            'player_id' => $this->player_id,
            'tripname' => $this->tripname,
            'tripday' => $this->tripday,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'temperature' => $this->temperature,
            'water_temperature' => $this->water_temperature,
            'clouds' => $this->clouds,
            'wind_mps' => $this->wind_mps,
            'wind_direction' => $this->wind_direction,
            'description' => $this->description,
            'id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Trip WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    /*
     * VALIDATORS
     */

    public function validate_tripname() {
        $errors = array();
        if (self::validate_string_length($this->tripname, 3)) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä.';
        }
        if (!self::validate_string_length($this->tripname, 51)) {
            $errors[] = 'Nimen tulee olla enintään 50 merkkiä pitkä.';
        }
        return $errors;
    }

    public function validate_tripday() {
        $errors = array();

        if (self::validate_date($this->tripday)) {
            $errors[] = 'Valitse päivämäärä tai syötä muodossa VVVV-KK-PP';
        }

        return $errors;
    }

    public function validate_start_and_end_time() {
        $errors = array();

        if (self::validate_time($this->start_time)) {
            $errors[] = 'Valitse aloitusaika tai syötä muodossa TT:MM';
        }
        if (self::validate_time($this->end_time)) {
            $errors[] = 'Valitse lopetussaika tai syötä muodossa TT:MM';
        }

        return $errors;
    }

    public function validate_temperatures() {
        $errors = array();
        if (!self::validate_in_range($this->temperature, -100, 100)) {
            $errors[] = 'Syötä lämpötila numeroina väliltä [-100, 100]';
        }
        if (!self::validate_in_range($this->water_temperature, 0, 100)) {
            $errors[] = 'Syötä veden lämpötila numeroina väliltä [0, 100]';
        }

        return $errors;
    }

    public function validate_clouds() {
        $errors = array();
        if (!in_array($this->clouds, self::$CLOUDS_TYPES)) {
            $errors[] = 'Valitse pilvisyys.';
        }
        return $errors;
    }

    public function validate_wind_mps() {
        $errors = array();
        if (!self::validate_in_range($this->wind_mps, 0, 100)) {
            $errors[] = 'Syötä tuulen nopeus metreinä sekunnissa, numero väliltä [0, 100]';
        }
        return $errors;
    }

    public function validate_wind_direction() {
        $errors = array();
        if (!in_array($this->wind_direction, self::$WIND_DIRECTIONS)) {
            $errors[] = 'Valitse tuulen suunta';
        }
        return $errors;
    }

    public function validate_description() {
        $errors = array();

        if (!self::validate_string_length($this->description, 1001)) {
            $errors[] = 'Kuvauksen tulee olla enintään 1000 merkkiä pitkä.';
        }
        return $errors;
    }

}
