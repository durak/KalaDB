<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  View::make('home.html');
        echo 'tämä on etusivu';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
//      echo 'Hello World!';
        View::make('helloworld.html');
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
