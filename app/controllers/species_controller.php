<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SpeciesController
 *
 * @author itkoskin
 */
class SpeciesController extends BaseController {

    public static function index() {

        $speciess = Species::all();
        View::make('species/index.html', array('speciess' => $speciess));
    }

    public static function show($id) {
        $species = Species::find($id);        

        $options = array('player_id' => self::get_user_logged_in()->id, 'species_id' => $id);
        $fishs = Fish::AllWith($options);        

        View::make('species/species_show.html', array('species' => $species, 'fishs' => $fishs));
//        Redirect::to('/', array('message' => 'not implemented yet!'));
    }

}
