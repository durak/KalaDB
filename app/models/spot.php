<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Spot
 *
 * @author itkoskin
 */
class Spot extends BaseModel {

    public $id, $player_id, $spotname, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_spotname', 'validate_description');
    }

    /*
     * CRUD
     */

    private static function selectAttributes($row) {

        return array(
            'id' => $row['id'],
            'player_id' => $row['player_id'],
            'spotname' => $row['spotname'],
            'description' => $row['description']
        );
    }

    public static function all($id) {
        $query = DB::connection()->prepare('SELECT * FROM Spot WHERE player_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $spots = array();

        foreach ($rows as $row) {
            $spots[] = new Spot(self::selectAttributes($row));
        }
        
        return $spots;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Spot WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $spot = new Spot(self::selectAttributes($row));

            return $spot;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Spot (player_id, spotname, description) VALUES (:player_id, :spotname, :description) RETURNING id');
        $query->execute(array(
            'player_id' => $this->player_id,
            'spotname' => $this->spotname,
            'description' => $this->description
        ));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Spot SET spotname = :spotname, description = :description WHERE id = :id');
        $query->execute(array(
            'spotname' => $this->spotname,
            'description' => $this->description,
            'id' => $this->id
        ));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Spot WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    /*
     * VALIDATORS
     */

    public function validate_spotname() {
        $errors = array();
        if (self::validate_string_length($this->spotname, 3)) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä.';
        }
        if (!self::validate_string_length($this->spotname, 101)) {
            $errors[] = 'Nimen tulee olla enintään 100 merkkiä pitkä.';
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
