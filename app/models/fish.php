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

    static protected $FISHING_METHODS = array('heitto', 'veto', 'jigaus', 'onki', 'pilkki', 'perho');
    public $id, $player_id, $trip_id, $species_id, $spot_id, $lure_id, $weight, $length_cm, $fishing_method, $fish_description;

    public static function all($id) {
        $query = DB::connection()->prepare('SELECT * FROM Fish WHERE player_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $fishs = array();

        foreach ($rows as $row) {
            $fishs[] = new Fish(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'trip_id' => $row['trip_id'],
                'species_id' => $row['species_id'],
                'spot_id' => $row['spot_id'],
                'lure_id' => $row['lure_id'],
                'weight' => $row['weight'],
                'length_cm' => $row['length_cm'],
                'fishing_method' => $row['fishing_method'],
                'fish_description' => $row['fish_description']
            ));
        }
        return $fishs;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Fish WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $fish = new Fish(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'trip_id' => $row['trip_id'],
                'species_id' => $row['species_id'],
                'spot_id' => $row['spot_id'],
                'lure_id' => $row['lure_id'],
                'weight' => $row['weight'],
                'length_cm' => $row['length_cm'],
                'fishing_method' => $row['fishing_method'],
                'fish_description' => $row['fish_description']
            ));

            return $fish;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (:player_id, :trip_id, :species_id, :spot_id, :lure_id, :weight, :length_cm, :fishing_method, :fish_description) RETURNING id');
        $query->execute(array('player_id' => $this->player_id,
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
        $query->execute(array('species_id' => $this->species_id,
            'spot_id' => $this->spot_id,
            'lure_id' => $this->lure_id,
            'weight' => $this->weight,
            'length_cm' => $this->length_cm,
            'fishing_method' => $this->fishing_method,
            'fish_description' => $this->fish_description,
            'id' => $this->id));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Trip WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public static function getFishingMethods() {
        return self::$FISHING_METHODS;
    }
}
