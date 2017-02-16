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
        Redirect::to('/', array('error' => 'not implemented yet!'));  
        
    }

}
