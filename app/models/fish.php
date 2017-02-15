<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fish
 *
 * @author itkoskin
 */
class Fish extends BaseModel {

    static $FISHING_METHODS = array(
        'heitto',
        'veto',
        'jigaus',
        'onki',
        'pilkki',
        'perho'
    );
    public $id, $player_id, $weight, $length_cm, $fishing_method, $fish_description;
    public $trip_id, $tripday, $tripname, $start_time, $end_time, $temperature, $water_temperature, $clouds, $wind_mps, $wind_direction;
    public $species_id, $name_fin, $name_lat;
    public $spot_id, $spotname;
    public $lure_id, $lurename, $luretype, $color;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    /*
     * CRUD
     */

    private static function selectAttributes($row) {

        return array(
            // table Fish
            'id' => $row['id'],
            'player_id' => $row['player_id'],
            'weight' => $row['weight'],
            'length_cm' => $row['length_cm'],
            'fishing_method' => $row['fishing_method'],
            'fish_description' => $row['fish_description'],
            // table Trip
            'trip_id' => $row['trip_id'],
            'tripday' => $row['tripday'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'temperature' => $row['temperature'],
            'water_temperature' => $row['water_temperature'],
            'clouds' => $row['clouds'],
            'wind_mps' => $row['wind_mps'],
            'wind_direction' => $row['wind_direction'],
            // table Species
            'species_id' => $row['species_id'],
            'name_fin' => $row['name_fin'],
            'name_lat' => $row['name_lat'],
            // table Spot
            'spot_id' => $row['spot_id'],
            'spotname' => $row['spotname'],
            // table Lure
            'lure_id' => $row['lure_id'],
            'lurename' => $row['lurename'],
            'luretype' => $row['luretype'],
            'color' => $row['color']
        );
    }

    public static function all($id) {
//        $query = DB::connection()->prepare('SELECT * FROM Fish WHERE player_id = :id');
        $query = DB::connection()->prepare(
                'SELECT Fish.*,
                    Trip.tripname,
                    Trip.tripday,
                    Trip.start_time,
                    Trip.end_time,
                    Trip.temperature,
                    Trip.water_temperature,
                    Trip.clouds,
                    Trip.wind_mps,
                    Trip.wind_direction,
                    Species.name_fin,
                    Species.name_lat,
                    Spot.spotname,
                    Lure.lurename,
                    Lure.luretype,
                    Lure.color
                FROM Fish
                INNER JOIN Trip
                    ON trip_id = Trip.id
                INNER JOIN Species
                    ON species_id = Species.id
                INNER JOIN Spot
                    ON spot_id = Spot.id
                INNER JOIN Lure
                    ON lure_id = Lure.id
                WHERE Fish.player_id = :id'
        );
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $fishs = array();

        foreach ($rows as $row) {
            $fishs[] = new Fish(self::selectAttributes($row));
        }

        return $fishs;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Fish WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $fish = self::selectAttributes($row);

            return $fish;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (:player_id, :trip_id, :species_id, :spot_id, :lure_id, :weight, :length_cm, :fishing_method, :fish_description) RETURNING id');
        $query->execute(array(
            'player_id' => $this->player_id,
            'trip_id' => $this->trip_id,
            'species_id' => $this->species_id,
            'spot_id' => $this->spot_id,
            'lure_id' => $this->lure_id,
            'weight' => $this->weight,
            'length_cm' => $this->length_cm,
            'fishing_method' => $this->fishing_method,
            'fish_description' => $this->fish_description
        ));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Fish SET species_id = :species_id, spot_id = :spot_id, lure_id = :lure_id, weight = :weight, length_cm = :length_cm, fishing_method = :fishing_method, fish_description = :fish_description WHERE id = :id');
        $query->execute(array(
            'species_id' => $this->species_id,
            'spot_id' => $this->spot_id,
            'lure_id' => $this->lure_id,
            'weight' => $this->weight,
            'length_cm' => $this->length_cm,
            'fishing_method' => $this->fishing_method,
            'fish_description' => $this->fish_description,
            'id' => $this->id
        ));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Trip WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

}
