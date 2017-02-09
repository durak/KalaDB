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
        $luretypes = Lure::getLureTypes();
        $lurecolors = Lure::getLureColors();
        View::make('lure/new.html', array('luretypes' => $luretypes,
            'lurecolors' => $lurecolors));
    }

    public static function store() {
        $params = $_POST;
        // uusi olio
        $lure = new Lure(array(
            'lurename' => $params['lurename'],
            'luretype' => $params['luretype'],
            'color' => $params['color']
        ));

        $errors = $lure->errors();
        if (count($errors) == 0) {
            $lure->save();
            Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe lisätty!'));
        } else {
            // löytyi virheitä
            $luretypes = Lure::getLureTypes();
            $lurecolors = Lure::getLureColors();
            View::make('lure/new.html', array('errors' => $errors,
                'lurename_value' => $lure->lurename,
                'luretype_selected' => $lure->luretype,
                'color_selected' => $lure->color,
                'luretypes' => $luretypes,
                'lurecolors' => $lurecolors));
        }
    }

    public static function edit($id) {
        $luretypes = Lure::getLureTypes();
        $lurecolors = Lure::getLureColors();
        $lure = Lure::find($id);
        View::make('lure/edit.html', array('attributes' => $lure, 'luretypes' => $luretypes, 'lurecolors' => $lurecolors));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'lurename' => $params['lurename'],
            'luretype' => $params['luretype'],
            'color' => $params['color']
        );

        $lure = new Lure($attributes);
        $errors = $lure->errors();

        if (count($errors) > 0) {
            $luretypes = Lure::getLureTypes();
            $lurecolors = Lure::getLureColors();
            View::make('lure/edit.html', array('attributes' => $attributes, 'errors' => $errors, 'luretypes' => $luretypes, 'lurecolors' => $lurecolors));
        } else {
            $lure->update();
            Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe muokattu.'));
        }
    }

    public static function destroy($id) {
        $lure = new Lure(array('id' => $id));
        $lure->destroy();
        Redirect::to('/lure', array('message' => 'Viehe poistettu'));
    }

}
