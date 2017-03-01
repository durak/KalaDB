<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TripController
 *
 * @author itkoskin
 */
class TripController extends BaseController {

    public static function index() {
        $user = self::get_user_logged_in();
        $id = $user->id;
        $trips = Trip::all($id);

        View::make('trip/index.html', array('trips' => $trips));
    }

    public static function show($id) {
        $trip = Trip::find($id);
        self::check_is_owner($trip);

        $options = array('player_id' => self::get_user_logged_in()->id, 'trip_id' => $id);
        $fishs = Fish::AllWith($options);

        $speciess_counts = Species::countOfFishInSpeciesWith($options);
        View::make('trip/trip_show.html', array('trip' => $trip, 'fishs' => $fishs, 'speciess_counts' => $speciess_counts));
    }

    public static function create() {

        View::make('trip/new.html', array('cloudtypes' => Trip::$CLOUDS_TYPES,
            'winddirections' => Trip::$WIND_DIRECTIONS));
    }

    public static function store() {
        $attributes = self::postAttributes();
        $trip = new Trip($attributes);
        $errors = $trip->errors();

        if (count($errors) > 0) {            

            View::make('trip/new.html', array('attributes' => $attributes,
                'errors' => $errors, 'cloudtypes' => Trip::$CLOUDS_TYPES,
                'winddirections' => Trip::$WIND_DIRECTIONS));
        } else {

            $trip->save();
            Redirect::to('/trip/' . $trip->id, array('message' => 'Kalareissu lisätty!'));
        }
    }

    public static function edit($id) {
        $trip = Trip::find($id);
        self::check_is_owner($trip);


        View::make('trip/edit.html', array('attributes' => $trip,
            'cloudtypes' => Trip::$CLOUDS_TYPES, 'winddirections' => Trip::$WIND_DIRECTIONS));
    }

    public static function update($id) {
        self::check_is_owner(Trip::find($id));

        $attributes = self::postAttributes();
        $attributes['id'] = $id;
        $trip = new Trip($attributes);
        $errors = $trip->errors();

        if (count($errors) > 0) {

            View::make('trip/edit.html', array('attributes' => $attributes,
                'errors' => $errors, 'cloudtypes' => Trip::$CLOUDS_TYPES,
                'winddirections' => Trip::$WIND_DIRECTIONS));
        } else {

            $trip->update();
            Redirect::to('/trip/' . $trip->id, array('message' => 'Kalareissu muokattu.'));
        }
    }

    public static function destroy($id) {
        $trip = Trip::find($id);
        self::check_is_owner($trip);

        $trip->destroy();
        Redirect::to('/trip', array('message' => 'Kalareissu poistettu'));
    }

    private static function postAttributes() {
        $params = $_POST;
        $attributes = array(
            'player_id' => self::get_user_logged_in()->id,
            'tripname' => $params['tripname'],
            'tripday' => $params['tripday'],
            'start_time' => $params['start_time'],
            'end_time' => $params['end_time'],
            'temperature' => $params['temperature'],
            'water_temperature' => $params['water_temperature'],
            'clouds' => $params['clouds'],
            'wind_mps' => $params['wind_mps'],
            'wind_direction' => $params['wind_direction'],
            'description' => $params['description']
        );

        return $attributes;
    }

}
