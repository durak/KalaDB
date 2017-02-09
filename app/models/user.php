<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author itkoskin
 */
class User extends BaseModel {

    public $id, $username;

    public function __construct($attributes) {
        parent::__construct($attributes);
        
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE playername = :playername AND password = :password LIMIT 1');
        $query->execute(array('playername' => $username, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array('id' => $row['id'], 'username' => $row['playername']));
                                    
            return $user;
        } else {
            return null;
        }
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');        
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array('id' => $row['id'], 'username' => $row['playername']));
            
            return $user;
        } else {

            return null;
        }
    }

    public function validate_username() {
        $errors = array();
        if (self::validate_string_length($this->username, 4) || !self::validate_string_length($this->username, 21)) {
            $errors[] = 'Käyttäjänimen tulee olla 4 - 20 merkkiä pitkä.';
        }
        return $errors;
    }

}
