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
        self::check_is_owner($lure);

        View::make('lure/lure_show.html', array('lure' => $lure));
    }

    public static function create() {

        View::make('lure/new.html', array('luretypes' => Lure::getLureTypes(),
            'lurecolors' => Lure::getLureColors()));
    }

    public static function store() {
        $attributes = self::postAttributes();
        $lure = new Lure($attributes);
        $errors = $lure->errors();

        if (count($errors) > 0) {
            View::make('lure/new.html', array('attributes' => $attributes,
                'errors' => $errors, 'luretypes' => Lure::getLureTypes(),
                'lurecolors' => Lure::getLureColors()));
        } else {
            
            $lure->save();
            Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe lisätty!'));
        }
    }

    public static function edit($id) {
        $lure = Lure::find($id);
        self::check_is_owner($lure);

        View::make('lure/edit.html', array('attributes' => $lure,
            'luretypes' => Lure::getLureTypes(), 'lurecolors' => Lure::getLureColors()));
    }

    public static function update($id) {
        self::check_is_owner(Lure::find($id));

        $attributes = self::postAttributes();
        $attributes['id'] = $id;
        $lure = new Lure($attributes);
        $errors = $lure->errors();

        if (count($errors) > 0) {

            View::make('lure/edit.html', array('attributes' => $attributes,
                'errors' => $errors, 'luretypes' => Lure::getLureTypes(),
                'lurecolors' => Lure::getLureColors()));
        } else {

            $lure->update();
            Redirect::to('/lure/' . $lure->id, array('message' => 'Viehe muokattu.'));
        }
    }

    public static function destroy($id) {
        $lure = Lure::find($id);
        self::check_is_owner($lure);
        $lure->destroy();

        Redirect::to('/lure', array('message' => 'Viehe poistettu'));
    }

    private static function postAttributes() {
        $params = $_POST;
        $attributes = array(
            'player_id' => self::get_user_logged_in()->id,
            'lurename' => $params['lurename'],
            'luretype' => $params['luretype'],
            'color' => $params['color']
        );

        return $attributes;
    }

}
