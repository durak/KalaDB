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

        View::make('trip/trip_show.html', array('trip' => $trip));
    }

    public static function create() {
        $cloudtypes = Trip::getCloudTypes();
        $winddirections = Trip::getWindDirections();
        View::make('trip/new.html', array('cloudtypes' => $cloudtypes,
            'winddirections' => $winddirections));
    }

    public static function store() {
        $params = $_POST;
        // uusi olio
        $attributes = array(
            'player_id' => self::get_user_logged_in()->id,
            'tripname' => $params['tripname'],
            'triptype' => $params['triptype'],
            'color' => $params['color']
        );

        $trip = new Trip($attributes);
        $errors = $trip->errors();

        if (count($errors) == 0) {
            $trip->save();
            Redirect::to('/trip/' . $trip->id, array('message' => 'Viehe lisätty!'));
        } else {
            // löytyi virheitä
            $cloudtypes = Trip::getCloudTypes();
            $winddirections = Trip::getWindDirections();
            View::make('trip/new.html', array('attributes' => $attributes,
                'errors' => $errors, 'cloudtypes' => $cloudtypes,
                'winddirections' => $winddirections));
        }
    }

    public static function edit($id) {
        $trip = Trip::find($id);
        self::check_is_owner($trip);

        $cloudtypes = Trip::getCloudTypes();
        $winddirections = Trip::getWindDirections();

        View::make('trip/edit.html', array('attributes' => $trip,
            'cloudtypes' => $cloudtypes, 'winddirections' => $winddirections));
    }

    public static function update($id) {
        $oldtrip = Trip::find($id);
        self::check_is_owner($oldtrip);

        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'tripname' => $params['tripname'],
            'triptype' => $params['triptype'],
            'color' => $params['color']
        );

        $trip = new Trip($attributes);
        $errors = $trip->errors();

        if (count($errors) > 0) {
            $cloudtypes = Trip::getCloudTypes();
            $winddirections = Trip::getWindDirections();

            View::make('trip/edit.html', array('attributes' => $attributes,
                'errors' => $errors, 'cloudtypes' => $cloudtypes,
                'winddirections' => $winddirections));
        } else {
            $trip->update();
            Redirect::to('/trip/' . $trip->id, array('message' => 'Viehe muokattu.'));
        }
    }

    public static function destroy($id) {
        $trip = Trip::find($id);
        self::check_is_owner($trip);
        $trip->destroy();

        Redirect::to('/trip', array('message' => 'Viehe poistettu'));
    }

}
