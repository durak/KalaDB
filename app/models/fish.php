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
    //

    private static $FISHQUERY = 'SELECT Fish.*,
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
                WHERE Fish.player_id = :player_id';
    //

    private static $SAVEQUERY = 'INSERT INTO Fish (
                    player_id,
                    trip_id,
                    species_id,
                    spot_id,
                    lure_id,
                    weight,
                    length_cm,
                    fishing_method,
                    fish_description) 
                VALUES (
                    :player_id,
                    :trip_id,
                    :species_id,
                    :spot_id,
                    :lure_id,
                    :weight,
                    :length_cm,
                    :fishing_method,
                    :fish_description)
                RETURNING id';
    //

    private static $UPDATEQUERY = 'UPDATE Fish
                SET species_id = :species_id,
                        spot_id = :spot_id,
                        lure_id = :lure_id,
                        weight = :weight,
                        length_cm = :length_cm,
                        fishing_method = :fishing_method,
                        fish_description = :fish_description
                WHERE id = :id';
    //

    public $id, $player_id, $weight, $length_cm, $fishing_method, $fish_description;
    public $trip_id, $tripday, $tripname, $start_time, $end_time, $temperature, $water_temperature, $clouds, $wind_mps, $wind_direction;
    public $species_id, $name_fin, $name_lat;
    public $spot_id, $spotname;
    public $lure_id, $lurename, $luretype, $color;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_trip', 'validate_spot', 'validate_lure', 'validate_fishing_method', 'validate_weight', 'validate_length');
    }

    /*
     * CRUD
     */


    /*
     * Return all fishes with a player ID and optionally only with a certain:
     *  - spot
     *  - lure
     *  - trip
     *  - species
     */

    public static function AllWith($options) {
        $query_string = self::$FISHQUERY;
        $query_options = array('player_id' => $options['player_id']);

        if (isset($options['spot_id'])) {
            $query_string .= ' AND Fish.spot_id = :spot_id';
            $query_options['spot_id'] = $options['spot_id'];
        } elseif (isset($options['lure_id'])) {
            $query_string .= ' AND Fish.lure_id = :lure_id';
            $query_options['lure_id'] = $options['lure_id'];
        } elseif (isset($options['trip_id'])) {
            $query_string .= ' AND Fish.trip_id = :trip_id';
            $query_options['trip_id'] = $options['trip_id'];
        } elseif (isset($options['species_id'])) {
            $query_string .= ' AND Fish.species_id = :species_id';
            $query_options['species_id'] = $options['species_id'];
        }

        $query = DB::connection()->prepare($query_string);
        $query->execute($query_options);
        $rows = $query->fetchAll();
        $fishs = array();

        foreach ($rows as $row) {
            $fishs[] = new Fish($row);
        }

        return $fishs;
    }

    public static function find($options) {
        $query_string = self::$FISHQUERY;
        $query_string .= ' AND Fish.id = :fish_id LIMIT 1';

        $query = DB::connection()->prepare($query_string);
        $query->execute($options);
        $row = $query->fetch();

        if ($row) {
            $fish = new Fish($row);

            return $fish;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare(self::$SAVEQUERY);
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
        $query = DB::connection()->prepare(self::$UPDATEQUERY);
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
        $query = DB::connection()->prepare('DELETE FROM Fish WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    /*
     * VALIDATORS
     */

    public function validate_trip() {
        $errors = array();

        if ($this->trip_id == "noselection") {
            $errors[] = 'Valitse reissu';
        } else {
            $trip = Trip::find($this->trip_id);
            if (!$trip || $this->player_id != $trip->player_id) {
                $errors[] = 'Virheellinen reissuvalinta';
            }
        }

        return $errors;
    }

    public function validate_spot() {
        $errors = array();

        if ($this->spot_id == "noselection") {
            $errors[] = 'Valitse kalapaikka';
        } else {
            $spot = Spot::find($this->spot_id);
            if (!$spot || $this->player_id != $spot->player_id) {
                $errors[] = 'Virheellinen paikkavalinta';
            }
        }

        return $errors;
    }

    public function validate_lure() {
        $errors = array();

        if ($this->lure_id == "noselection") {
            $errors[] = 'Valitse viehe';
        } else {
            $lure = Lure::find($this->lure_id);
            if (!$lure || $this->player_id != $lure->player_id) {
                $errors[] = 'Virheellinen viehevalinta';
            }
        }

        return $errors;
    }

    public function validate_fishing_method() {
        $errors = array();
        if ($this->fishing_method == "noselection") {
            $errors[] = 'Valitse kalastustapa';
        } elseif (!in_array($this->fishing_method, self::$FISHING_METHODS)) {
            $errors[] = 'Virheellinen kalastustapa valittu.';
        }

        return $errors;
    }

    public function validate_weight() {
        $errors = array();
        if (!self::validate_in_range($this->weight, 0, 100)) {
            $errors[] = 'Syötä kalan paino kilogrammoina, desimaaliluku väliltä [0, 100]';
        }

        return $errors;
    }

    public function validate_length() {
        $errors = array();
        if (!self::validate_in_range($this->length_cm, 0, 1000)) {
            $errors[] = 'Syötä kalan pituus senttimetreinä, kokonaisluku väliltä [0, 1000]';
        }

        return $errors;
    }

    public function validate_description() {
        $errors = array();

        if (!self::validate_string_length($this->fish_description, 501)) {
            $errors[] = 'Kuvauksen tulee olla enintään 500 merkkiä pitkä.';
        }

        return $errors;
    }

}
