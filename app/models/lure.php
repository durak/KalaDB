<?php

/**
 * Description of Lure
 *
 * @author itkoskin
 */
class Lure extends BaseModel {

    public $id, $player_id, $lurename, $luretype, $color;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Lure');
        $query->execute();
        $rows = $query->fetchAll();
        $lures = array();

        foreach ($rows as $row) {
            $lures[] = new Lure(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'lurename' => $row['lurename'],
                'luretype' => $row['luretype'],
                'color' => $row['color']
            ));
        }
        return $lures;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Lure WHERE id = :id LIMIT 1');
        // assosaatiolista mitä muuttujia kyselyyn upotetaan
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $lure = new Lure(array(
                'id' => $row['id'],
                'player_id' => $row['player_id'],
                'lurename' => $row['lurename'],
                'luretype' => $row['luretype'],
                'color' => $row['color']
            ));

            return $lure;
        }

        return null;       
    }
    

    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Lure (lurename, luretype, color) VALUES (:lurename, :luretype, :color) RETURNING id');
        $query->execute(array('lurename' => $this->lurename, 'luretype' => $this->luretype, 'color' => $this->color));
        
        $row = $query->fetch();
        
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

}
