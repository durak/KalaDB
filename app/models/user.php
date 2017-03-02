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

    public $id, $username, $password, $password_confirmation;

    public function __construct($attributes) {
        parent::__construct($attributes);

        if (array_key_exists('password_confirmation', $attributes)) {
            $this->validators = array('validate_username', 'validate_password');
        }
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Player (playername, password) VALUES (:playername, :password) RETURNING id');
        $query->execute(array(
            'playername' => $this->username,
            'password' => $this->password
        ));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Player SET playername = :playername WHERE id = :id');
        $query->execute(array(
            'playername' => $this->username,
            'id' => $this->id
        ));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Player WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    // Validators

    public function validate_username() {
        $errors = array();

        if (self::validate_string_length($this->username, 4) || !self::validate_string_length($this->username, 21)) {
            $errors[] = 'Käyttäjänimen tulee olla 4 - 20 merkkiä pitkä';
        }
        if (self::check_if_user_exists($this->username)) {
            $errors[] = 'Käyttäjänimi on jo varattu, valitse uusi';
        }

        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if (self::validate_string_length($this->password, 6) || !self::validate_string_length($this->password, 31)) {
            $errors[] = 'Salasanan tulee olla 6 - 30 merkkiä pitkä';
        }
        if ($this->password != $this->password_confirmation) {
            $errors[] = 'Salasana ja vahvistus eivät täsmää, täytä uudestaan';
        }

        return $errors;
    }

    private static function check_if_user_exists($username) {
        $query = DB::connection()->prepare('SELECT * FROM Player WHERE playername = :playername LIMIT 1');
        $query->execute(array('playername' => $username));
        $row = $query->fetch();

        return $row != null;
    }

}
