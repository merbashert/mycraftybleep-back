<?php
// $dbconn = pg_connect('host=localhost dbname=crafts');

$dbconn = null;
if(getenv('DATABASE_URL')){
    $connectionConfig = parse_url(getenv('DATABASE_URL'));
    $host = $connectionConfig['host'];
    $user = $connectionConfig['user'];
    $password = $connectionConfig['pass'];
    $port = $connectionConfig['port'];
    $dbname = trim($connectionConfig['path'],'/');
    $dbconn = pg_connect(
        "host=".$host." ".
        "user=".$user." ".
        "password=".$password." ".
        "port=".$port." ".
        "dbname=".$dbname
    );
} else {
    $dbconn = pg_connect("host=localhost dbname=crafts");
}

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
        pg_query_params($query, $query_params);
        return self::all();
    }
    static function update($updated_zipper){
        $query = "UPDATE zippers SET size = $1, color=$2 WHERE id=$3";
        $query_params = array($updated_zipper->size, $updated_zipper->color, $updated_zipper->id);
        pg_query_params($query,$query_params);

        return self::all();
    }
    static function delete($id){
        $query = "DELETE FROM zippers WHERE id = $1";
        $query_params = array($id);
        pg_query_params($query, $query_params);

        return self::all();
    }
    static function all(){
        $zippers = array();

        $results = pg_query("SELECT * FROM zippers");

        $row_object = pg_fetch_object($results);
        while($row_object) {
            $new_random = new Zipper(
                intval($row_object->id),
                intval($row_object->size),
                $row_object->color
            );
            $zippers[] = $new_random;

            $row_object = pg_fetch_object($results);
        }
        return $zippers;
    }
}
?>
