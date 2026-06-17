<?php
require_once __DIR__ . '/../config/database.php';

class Zipper {
    public $id;
    public $size;
    public $color;
    public function __construct($id, $size, $color){
        $this->id = $id;
        $this->size = $size;
        $this->color = $color;
    }
}

class Zippers {
    static function create($zipper){
        $query = "INSERT INTO zippers (size, color) VALUES ($1, $2)";
        $query_params = array($zipper->size, $zipper->color);
        runQueryParams($query, $query_params);
        return self::all();
    }
    static function update($updated_zipper){
        $query = "UPDATE zippers SET size = $1, color=$2 WHERE id=$3";
        $query_params = array($updated_zipper->size, $updated_zipper->color, $updated_zipper->id);
        runQueryParams($query, $query_params);

        return self::all();
    }
    static function delete($id){
        $query = "DELETE FROM zippers WHERE id = $1";
        $query_params = array($id);
        runQueryParams($query, $query_params);

        return self::all();
    }
    static function all(){
        $zippers = array();

        $results = runQuery("SELECT * FROM zippers ORDER BY color");

        $row_object = pg_fetch_object($results);
        while($row_object) {
            $new_zipper = new Zipper(
                intval($row_object->id),
                intval($row_object->size),
                $row_object->color
            );
            $zippers[] = $new_zipper;

            $row_object = pg_fetch_object($results);
        }
        return $zippers;
    }
}
?>
