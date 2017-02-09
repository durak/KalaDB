<?php

/**
 * Description of lures_controller
 *
 * @author itkoskin
 */
class LureController extends BaseController {

    public static function index() {

        $user = self::get_user_logged_in();        
        $id = $user->id;
                
        $lures = Lure::all($id);
        View::make('lure/index.html', array('lures' => $lures));
    }

    public static function show($id) {
        $lure = Lure::find($id);
        if (!$lure or !self::match_logged_user($lure->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

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
        $attributes = array(
            'player_id' => self::get_user_logged_in()->id,
            'lurename' => $params['lurename'],
            'luretype' => $params['luretype'],
            'color' => $params['color']
        );

        $lure = new Lure($attributes);
        $errors = $lure->errors();

        if (count($errors) == 0) {
            $lure->save();
            Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe lisätty!'));
        } else {
            // löytyi virheitä
            $luretypes = Lure::getLureTypes();
            $lurecolors = Lure::getLureColors();
            View::make('lure/new.html', array('attributes' => $attributes,
                'errors' => $errors, 'luretypes' => $luretypes,
                'lurecolors' => $lurecolors));
        }
    }

    public static function edit($id) {
        $luretypes = Lure::getLureTypes();
        $lurecolors = Lure::getLureColors();
        $lure = Lure::find($id);

        if (!$lure or !self::match_logged_user($lure->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

        View::make('lure/edit.html', array('attributes' => $lure,
            'luretypes' => $luretypes, 'lurecolors' => $lurecolors));
    }

    public static function update($id) {
        $oldlure = Lure::find($id);
        if (!$oldlure || !self::match_logged_user($oldlure->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }

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

            View::make('lure/edit.html', array('attributes' => $attributes,
                'errors' => $errors, 'luretypes' => $luretypes,
                'lurecolors' => $lurecolors));
        } else {
            $lure->update();
            Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe muokattu.'));
        }
    }

    public static function destroy($id) {
        $lure = Lure::find($id);
        if (!$lure || !self::match_logged_user($lure->player_id)) {
            Redirect::to('/', array('error' => 'Ei oikeuksia!'));
        }
                
        $lure->destroy();
        Redirect::to('/lure', array('message' => 'Viehe poistettu'));
    }

}
