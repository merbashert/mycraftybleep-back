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


class Fabric {
    public $id;
    public $length;
    public $tags = array();
    public $main_color;
    public $picture;
    public function __construct($id, $length, $tags, $main_color, $picture){
        $this->id = $id;
        $this->length = $length;
        $this->tags = $tags;
        $this->main_color = $main_color;
        $this->picture = $picture;
    }
}

class Fabrics {
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

        $results = pg_query("SELECT * FROM fabrics
            ORDER BY (
                CASE main_color

                WHEN 'red'
                THEN 1

                WHEN 'orange'
                THEN 2

                WHEN 'yellow'
                THEN 3

                WHEN 'green'
                THEN 4

                WHEN 'blue'
                THEN 5

                WHEN 'purple'
                THEN 6

                WHEN 'pink'
                THEN 7

                WHEN 'brown'
                THEN 8

                WHEN 'black'
                THEN 9

                WHEN 'white'
                THEN 10

                END
            ) ASC, id ASC"
        );

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
