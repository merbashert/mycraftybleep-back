<?php

$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
    $connectionConfig = parse_url($databaseUrl);
    $host = $connectionConfig['host'];
    $user = $connectionConfig['user'];
    $password = $connectionConfig['pass'];
    $port = $connectionConfig['port'];
    $dbname = trim($connectionConfig['path'], '/');

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

?>
