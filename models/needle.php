<?php
require_once __DIR__ . '/../config/database.php';

class Needle {
    public $id;
    public $size;
    public $straight;
    public $circular;
    public $doublepoint;
    public function __construct($id, $size, $straight, $circular, $doublepoint){
        $this->id = $id;
        $this->size = $size;
        $this->straight = $straight;
        $this->circular = $circular;
        $this->doublepoint = $doublepoint;
    }
}

class Needles {
    static function create($needle){
        $query = "INSERT INTO needles (size, straight, circular, doublepoint) VALUES ($1, $2, $3, $4)";
        $query_params = array($needle->size, $needle->straight, $needle->circular, $needle->doublepoint);
        runQueryParams($query, $query_params);
        return self::all();
    }
    static function update($updated_needle){
        $query = "UPDATE needles SET size = $1, straight=$2, circular=$3, doublepoint=$4 WHERE id=$5";
        $query_params = array($updated_needle->size, $updated_needle->straight, $updated_needle->circular, $updated_needle->doublepoint, $updated_needle->id);
        runQueryParams($query, $query_params);

        return self::all();
    }
    static function delete($id){
        $query = "DELETE FROM needles WHERE id = $1";
        $query_params = array($id);
        runQueryParams($query, $query_params);

        return self::all();
    }
    static function all(){
        $needles = array();

        $results = runQuery("SELECT * FROM needles ORDER BY size ASC");

        $row_object = pg_fetch_object($results);
        while($row_object) {
            $new_needle = new Needle(
                intval($row_object->id),
                intval($row_object->size),
                $row_object->straight,
                $row_object->circular,
                $row_object->doublepoint
            );
            $needles[] = $new_needle;

            $row_object = pg_fetch_object($results);
        }
        return $needles;
    }
}
?>
