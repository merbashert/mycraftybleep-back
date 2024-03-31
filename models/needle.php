<?php
// $dbconn = pg_connect('host=localhost dbname=crafts');

$dbconn = null;
if(getenv('DATABASE_URL')){
        $connectionConfig = parse_url(getenv('DATABASE_URL'));
    $host = "localhost"; //$connectionConfig['host'];
    $user = "meredjt3_WPVUY"; //$connectionConfig['user'];
    $password = "cowpoop81!"; // $connectionConfig['pass'];
    $port = "5432"; //$connectionConfig['port'];
    $dbname = "meredjt3_pg_mycraftybleep"; //trim($connectionConfig['path'],'/');
    $dbconn = pg_connect(
        "host=".$host." ".
        "user=".$user." ".
        "password=".$password." ".
        "port=".$port." ".
        "dbname=".$dbname
    );
} else {
    $dbconn = pg_connect("host=localhost user=meredjt3_WPVUY password=cowpoop81! dbname=meredjt3_pg_mycraftybleep");
}

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
        pg_query_params($query, $query_params);
        return self::all();
    }
    static function update($updated_needle){
        $query = "UPDATE needles SET size = $1, straight=$2, circular=$3, doublepoint=$4 WHERE id=$5";
        $query_params = array($updated_needle->size, $updated_needle->straight, $updated_needle->circular, $updated_needle->doublepoint, $updated_needle->id);
        pg_query_params($query,$query_params);

        return self::all();
    }
    static function delete($id){
        $query = "DELETE FROM needles WHERE id = $1";
        $query_params = array($id);
        pg_query_params($query, $query_params);

        return self::all();
    }
    static function all(){
        $needles = array();

        $results = pg_query("SELECT * FROM needles ORDER BY size ASC");

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
