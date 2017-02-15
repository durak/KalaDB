<?php

/**
 * Description of Lure
 *
 * @author itkoskin
 */
class Lure extends BaseModel {

    static $LURE_TYPES = array(
        'lusikka',
        'vaappu',
        'jigi',
        'lippa',
        'perho',
        'pilkki'
    );
    static $LURE_COLORS = array(
        'sininen',
        'keltainen',
        'punainen',
        'vihreä',
        'oranssi',
        'ruskea',
        'papukaija',
        'luonnonväri'
    );
    public $id, $player_id, $lurename, $luretype, $color;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_lurename', 'validate_luretype', 'validate_lurecolor');
    }

    /*
     * CRUD
     */

    private static function selectAttributes($row) {

        return array(
            'id' => $row['id'],
            'player_id' => $row['player_id'],
            'lurename' => $row['lurename'],
            'luretype' => $row['luretype'],
            'color' => $row['color']
        );
    }

    public static function all($id) {
        $query = DB::connection()->prepare('SELECT * FROM Lure WHERE player_id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $lures = array();

        foreach ($rows as $row) {
            $lures[] = new Lure(self::selectAttributes($row));
        }

        return $lures;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Lure WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $lure = new Lure(self::selectAttributes($row));

            return $lure;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (:player_id, :lurename, :luretype, :color) RETURNING id');
        $query->execute(array(
            'player_id' => $this->player_id,
            'lurename' => $this->lurename,
            'luretype' => $this->luretype,
            'color' => $this->color
        ));

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Lure SET lurename = :lurename, luretype = :luretype, color = :color WHERE id = :id');
        $query->execute(array(
            'lurename' => $this->lurename,
            'luretype' => $this->luretype,
            'color' => $this->color,
            'id' => $this->id
        ));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Lure WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    /*
     * VALIDATORS
     */

    public function validate_lurename() {
        $errors = array();
        if (self::validate_string_length($this->lurename, 3)) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä pitkä.';
        }
        if (!self::validate_string_length($this->lurename, 51)) {
            $errors[] = 'Nimen tulee olla enintään 50 merkkiä pitkä.';
        }
        return $errors;
    }

    public function validate_luretype() {
        $errors = array();
        if (!in_array($this->luretype, self::$LURE_TYPES)) {
            $errors[] = 'Vieheen tyyppi virheellinen.';
        }
        return $errors;
    }

    public function validate_lurecolor() {
        $errors = array();
        if (!in_array($this->color, self::$LURE_COLORS)) {
            $errors[] = 'Vieheen väri virheellinen.';
        }
        return $errors;
    }

}
