<?php

//require 'app/models/lure.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  View::make('home.html');
        echo 'tämä on etusivu';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
//        $eka = Lure::find(1);
//        $kaikki = Lure::all();
//        $liianlyhytlure = new Lure(array(
//            'lurename' => 'asd',
//            'luretype' => 'lusikka',
//            'color' => 'sininen'
//        ));
//        $errors = $liianlyhytlure->errors();
//        
//        Kint::dump($errors);
//        Kint::dump($eka);
//        Kint::dump($kaikki);
//        
//        $user = self::get_user_logged_in();
//        
//        $ykkonen = self::match_logged_user(1);
//        $kakkonen = self::match_logged_user(2);
//        
//        Kint::dump($user);
//        Kint::dump($ykkonen);
//        Kint::dump($kakkonen);
        
//      echo 'Hello World!';
//        View::make('helloworld.html');
    }

    public static function trip_list() {
        View::make('suunnitelmat/trip_list.html');
    }

    public static function trip_show() {
        View::make('suunnitelmat/trip_show.html');
    }

    public static function spot_list() {
        View::make('suunnitelmat/spot_list.html');
    }

    public static function spot_show() {
        View::make('suunnitelmat/spot_show.html');
    }

    public static function fish_list() {
        View::make('suunnitelmat/fish_list.html');
    }

    public static function fish_show() {
        View::make('suunnitelmat/fish_show.html');
    }

    public static function lure_list() {
        View::make('suunnitelmat/lure_list.html');
    }

    public static function lure_show() {
        View::make('suunnitelmat/lure_show.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }

}
