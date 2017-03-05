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



}
