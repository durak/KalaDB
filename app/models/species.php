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

}
