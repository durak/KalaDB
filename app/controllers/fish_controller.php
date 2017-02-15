<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FishController
 *
 * @author itkoskin
 */
class FishController extends BaseController {

    public static function index() {

        $user = self::get_user_logged_in();
        $id = $user->id;

        $fishs = Fish::all($id);
        View::make('fish/index.html', array('fishs' => $fishs));
    }

    public static function show($id) {
        $fish = Fish::find($id);
        self::check_is_owner($fish);
//        if (!$fish or ! self::match_logged_user($fish->player_id)) {
//            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
//        }

        View::make('fish/fish_show.html', array('fish' => $fish));
    }

    public static function create() {
        $fishingmethods = Fish::getFishingMethods();

        View::make('fish/new.html', array('fishingmethods' => $fishingmethods));
    }

    public static function store() {
        $params = $_POST;
        // uusi olio
        $attributes = array(
            'player_id' => $params['player_id'],
            'trip_id' => $params['trip_id'],
            'species_id' => $params['species_id'],
            'spot_id' => $params['spot_id'],
            'lure_id' => $params['lure_id'],
            'weight' => $params['weight'],
            'length_cm' => $params['length_cm'],
            'fishing_method' => $params['fishing_method'],
            'fish_description' => $params['fish_description']
        );

        $fish = new Fish($attributes);
        $errors = $fish->errors();

        if (count($errors) == 0) {
            $fish->save();
            Redirect::to('/fish/' . $fish->id, array('message' => 'Kala lisätty!'));
        } else {
            // löytyi virheitä
            $fishingmethods = Fish::getFishingMethods();
            View::make('fish/new.html', array('attributes' => $attributes,
                'errors' => $errors, 'fishingmethods' => $fishingmethods));
        }
    }

    public static function edit($id) {
        $fishingmethods = Fish::getFishingMethods();
        $fish = Fish::find($id);
        self::check_is_owner($fish);

        View::make('fish/edit.html', array('attributes' => $fish,
            'fishingmethods' => $fishingmethods));
    }

    public static function update($id) {
        $oldfish = Fish::find($id);
        self::check_is_owner($oldfish);

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'species_id' => $params['species_id'],
            'spot_id' => $params['spot_id'],
            'lure_id' => $params['lure_id'],
            'weight' => $params['weight'],
            'length_cm' => $params['length_cm'],
            'fishing_method' => $params['fishing_method'],
            'fish_description' => $params['fish_description']
        );

        $fish = new Fish($attributes);
        $errors = $fish->errors();

        if (count($errors) > 0) {
            $fishingmethods = Fish::getFishingMethods();

            View::make('fish/edit.html', array('attributes' => $attributes,
                'errors' => $errors, 'fishingmethods' => $fishingmethods));
        } else {
            $fish->update();
            Redirect::to('/fish/' . $fish->id, array('message' => 'Kala muokattu.'));
        }
    }

    public static function destroy($id) {
        $fish = Fish::find($id);
        self::check_is_owner($fish);

        $fish->destroy();
        Redirect::to('/fish', array('message' => 'Kala poistettu'));
    }

    private static function checkPermissions($fish) {
        if (!$fish or ! self::match_logged_user($fish->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }
    }

}
