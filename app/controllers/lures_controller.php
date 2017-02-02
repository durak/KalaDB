<?php

/**
 * Description of lures_controller
 *
 * @author itkoskin
 */
class LureController extends BaseController {

    public static function index() {
        $lures = Lure::all();
        View::make('lure/index.html', array('lures' => $lures));
    }

    public static function show($id) {
        $lure = Lure::find($id);
        View::make('lure/lure_show.html', array('lure' => $lure));
    }

    public static function create() {
        View::make('lure/new.html');
    }

    public static function store() {
        $params = $_POST;
        // uusi olio
        $lure = new Lure(array(
            'lurename' => $params['lurename'],
            'luretype' => $params['luretype'],
            'color' => $params['color']
        ));

//        Kint::dump($params);

        $lure->save();

        Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe lisätty!'));
    }

}
