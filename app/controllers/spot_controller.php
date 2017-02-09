<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SpotController
 *
 * @author itkoskin
 */
class SpotController extends BaseController {

    public static function index() {

        $user = self::get_user_logged_in();
        $id = $user->id;

        $spots = Spot::all($id);
        View::make('spot/index.html', array('spots' => $spots));
    }

    public static function show($id) {
        $spot = Spot::find($id);
        if (!$spot || !self::match_logged_user($spot->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

        View::make('spot/spot_show.html', array('spot' => $spot));
    }

    public static function create() {
        View::make('spot/new.html');
    }

    public static function store() {
        $params = $_POST;
        // uusi olio
        $attributes = array(
            'player_id' => self::get_user_logged_in()->id,
            'spotname' => $params['spotname'],
            'description' => $params['description']
        );

        $spot = new Spot($attributes);
        $errors = $spot->errors();

        if (count($errors) == 0) {
            $spot->save();
            Redirect::to('/spot/' . $spot->id, array('message' => 'Kalapaikka lisätty!'));
        } else {
            // löytyi virheitä
            View::make('spot/new.html', array('attributes' => $attributes,
                'errors' => $errors));
        }
    }

    public static function edit($id) {
        $spot = Spot::find($id);

        if (!$spot || !self::match_logged_user($spot->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

        View::make('spot/edit.html', array('attributes' => $spot));
    }

    public static function update($id) {
        $oldspot = Spot::find($id);
        if (!$oldspot || !self::match_logged_user($oldspot->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'spotname' => $params['spotname'],
            'description' => $params['description']
        );

        $spot = new Spot($attributes);
        $errors = $spot->errors();

        if (count($errors) > 0) {

            View::make('spot/edit.html', array('attributes' => $attributes,
                'errors' => $errors));
        } else {
            $spot->update();
            Redirect::to('/spot/' . $spot->id, array('message' => 'Kalapaikka muokattu.'));
        }
    }

    public static function destroy($id) {
        $spot = Spot::find($id);
        if (!$spot || !self::match_logged_user($spot->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

        $spot->destroy();
        Redirect::to('/spot', array('message' => 'Kalapaikka poistettu'));
    }

}
