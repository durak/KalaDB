<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Species
 *
 * @author itkoskin
 */
class Species extends BaseModel {

    public $id, $name_fin, $name_lat;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Species');
        $query->execute();
        $rows = $query->fetchAll();
        $speciess = array();

        foreach ($rows as $row) {
            $speciess[] = new Species(array(
                'id' => $row['id'],
                'name_fin' => $row['name_fin'],
                'name_lat' => $row['name_lat']
            ));
        }
        return $speciess;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Species WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $species = new Species(array(
                'id' => $row['id'],
                'name_fin' => $row['name_fin'],
                'name_lat' => $row['name_lat']
            ));

            return $species;
        }

        return null;
    }


    public static function countOfFishInSpeciesWith($options) {
        $query_string = 'SELECT Species.name_fin, COUNT(Fish.id) AS NumberOfFish
                FROM Species
                LEFT JOIN Fish
                    ON Species.id = Fish.species_id                
                AND Fish.player_id = :player_id';
        
        $query_options = array('player_id' => $options['player_id']);

        if (isset($options['spot_id'])) {
            $query_string .= ' WHERE Fish.spot_id = :spot_id';
            $query_options['spot_id'] = $options['spot_id'];
        } elseif (isset($options['lure_id'])) {
            $query_string .= ' WHERE Fish.lure_id = :lure_id';
            $query_options['lure_id'] = $options['lure_id'];
        } elseif (isset($options['trip_id'])) {
            $query_string .= ' WHERE Fish.trip_id = :trip_id';
            $query_options['trip_id'] = $options['trip_id'];
        }
        
        $query_string .= ' GROUP BY Species.name_fin';
        
//        Kint::dump($query_string);
//        Kint::dump($query_options);
        
        
        $query = DB::connection()->prepare($query_string);
        $query->execute($query_options);
        
        $rows = $query->fetchAll();
        $speciess_counts = array();

        foreach ($rows as $row) {
            $speciess_counts[] = array(
                'name_fin' => $row['name_fin'],
                'count' => $row['numberoffish']
            );
        }

        if ($speciess_counts) {
            return $speciess_counts;
        }

        return null;
    }

}
