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

class Random {
    public $id;
    public $name;
    public $details;
    public $box_number;
    public function __construct($id, $name, $details, $box_number){
        $this->id = $id;
        $this->name = $name;
        $this->details = $details;
        $this->box_number = $box_number;
    }
}

class Randoms {
    static function create($random){
        $query = "INSERT INTO randoms (name, details, box_number) VALUES ($1, $2, $3)";
        $query_params = array($random->name, $random->details, $random->box_number);
        pg_query_params($query, $query_params);
        return self::all();
    }
    static function update($updated_random){
        $query = "UPDATE randoms SET name = $1, details=$2, box_number=$3 WHERE id=$4";
        $query_params = array($updated_random->name, $updated_random->details, $updated_random->box_number, $updated_random->id);
        pg_query_params($query,$query_params);

        return self::all();
    }
    static function delete($id){
        $query = "DELETE FROM randoms WHERE id = $1";
        $query_params = array($id);
        pg_query_params($query, $query_params);

        return self::all();
    }
    static function all(){
        $randoms = array();

        $results = pg_query("SELECT * FROM randoms ORDER BY name ASC");

        $row_object = pg_fetch_object($results);
        while($row_object) {
            $new_random = new Random(
                intval($row_object->id),
                $row_object->name,
                $row_object->details,
                $row_object->box_number
            );
            $randoms[] = $new_random;

            $row_object = pg_fetch_object($results);
        }
        return $randoms;
    }
}
?>
