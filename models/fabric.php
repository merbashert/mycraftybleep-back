<?php
$dbconn = pg_connect('host=localhost dblength=contacts');

class Fabric {
    public $id;
    public $length;
    public $tags;
    public $main_color;
    public $picture;
    public function __construct($id, $length, $tags, $picture){
        $this->id = $id;
        $this->length = $length;
        $this->tags = $tags;
        $this->main_color = $main_color;
        $this->picture = $picture;
    }
}

class Fabrics {
    //"factory class" - will run the CRUD functions
    static function create($fabric){
        $query = "INSERT INTO fabrics (length, tags, main_color, picture) VALUES ($1, $2, $3, $4)";
        $query_params = array($fabric->length, $fabric->tags, $fabric->main_color, $fabric->picture);
        pg_query_params($query, $query_params);
        return self::all();
    }
    static function update($updated_fabric){
        $query = "UPDATE fabrics SET length = $1, tags=$2, main_color=$3, picture=$4 WHERE id=$5";
        $query_params = array($updated_fabric->length, $updated_fabric->tags, $updated_fabric->main_color, $updated_fabric->picture, $updated_fabric->id);
        pg_query_params($query,$query_params);

        return self::all();
    }
    static function delete($id){
        $query = "DELETE FROM fabrics WHERE id = $1";
        $query_params = array($id);
        pg_query_params($query, $query_params);

        return self::all();
    }
    static function all(){
        $fabrics = array();

        $results = pg_query("SELECT * FROM fabrics");

        $row_object = pg_fetch_object($results);
        while($row_object) {
            $new_fabric = new Fabric(
                intval($row_object->id),
                $row_object->length,
                $row_object->tags,
                $row_object->main_color,
                $row_object->picture
            );
            $fabrics[] = $new_fabric;

            $row_object = pg_fetch_object($results);
        }
        return $fabrics;
    }
}
?>