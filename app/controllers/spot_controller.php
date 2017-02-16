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
        self::check_is_owner($spot);
        
        $fishs = Fish::AllWithSpot(self::get_user_logged_in()->id, $id);
        View::make('spot/spot_show.html', array('spot' => $spot, 'fishs' => $fishs));
    }

    public static function create() {

        View::make('spot/new.html');
    }

    public static function store() {
        $attributes = self::postAttributes();
        $spot = new Spot($attributes);
        $errors = $spot->errors();

        if (count($errors) > 0) {

            View::make('spot/new.html', array('attributes' => $attributes,
                'errors' => $errors));
        } else {

            $spot->save();
            Redirect::to('/spot/' . $spot->id, array('message' => 'Kalapaikka lisätty!'));
        }
    }

    public static function edit($id) {
        $spot = Spot::find($id);
        self::check_is_owner($spot);

        View::make('spot/edit.html', array('attributes' => $spot));
    }

    public static function update($id) {        
        self::check_is_owner(Spot::find($id));

        $attributes = self::postAttributes();
        $attributes['id'] = $id;        
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
        self::check_is_owner($spot);

        $spot->destroy();
        Redirect::to('/spot', array('message' => 'Kalapaikka poistettu'));
    }

    private static function postAttributes() {
        $params = $_POST;
        $attributes = array(
            'player_id' => self::get_user_logged_in()->id,
            'spotname' => $params['spotname'],
            'description' => $params['description']
        );

        return $attributes;
    }

}
