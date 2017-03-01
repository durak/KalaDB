<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }

        return $errors;
    }

    public static function validate_string_length($string, $length) {
        return (strlen($string) < $length);
    }

    public static function validate_date($date) {
        DateTime::createFromFormat('Y-m-d', $date);
        $date_errors = DateTime::getLastErrors();
        $error_count = $date_errors['error_count'];

        return $error_count > 0;
    }

    public static function validate_time($time) {
        DateTime::createFromFormat('Y-m-d H:i', "2001-01-01 " . $time);
        $date_errors = DateTime::getLastErrors();
        $error_count = $date_errors['error_count'];

        return $error_count > 0;
    }

    public static function validate_in_range($number, $lower, $upper) {
        if (!is_numeric($number)) {
            return false;
        } else {
            return ($number >= $lower && $number <= $upper);
        }
    }

}
