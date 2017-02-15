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

    static protected $CLOUDS_TYPES = array('selkeää', 'melko selkeää', 'puolipilvistä', 'melko pilvistä', 'pilvistä');
    static protected $WIND_DIRECTIONS = array('pohjoinen', 'koillinen', 'itä', 'kaakko', 'etelä', 'lounas', 'länsi', 'luode');
    public $id, $player_id, $tripname, $tripday, $start_time, $end_time, $temperature, $water_temperature, $clouds, $wind_mps, $wind_direction, $description;

    public static function all($id) {
        $query = DB::connection()->prepare('SELECT * FROM Trip WHERE player_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $trips = array();
        foreach ($rows as $row) {
            $trips[] = new Trip(array(
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
            ));
        }
        return $trips;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Trip WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $trip = new Trip(array(
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
            ));

            return $trip;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction, description) VALUES (:player_id, :tripname, :tripday, :start_time, :end_time, :temperature, :water_temperature, :clouds, :wind_mps, :wind_direction, :description) RETURNING id');
        $query->execute(array('player_id' => $this->player_id,
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
        $query->execute(array('player_id' => $this->player_id,
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

    public static function getCloudTypes() {
        return self::$CLOUDS_TYPES;
    }

    public static function getWindDirections() {
        return self::$WIND_DIRECTIONS;
    }

}
