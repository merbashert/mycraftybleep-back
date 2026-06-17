<?php

$dbconn = pg_connect("host=localhost user=meredjt3_WPVUY password=cowpoop81! dbname=meredjt3_pg_mycraftybleep");

function runQuery($query) {
    $result = pg_query($query);

    if (!$result) {
        http_response_code(500);
        echo json_encode(array("error" => "Database query failed"));
        exit;
    }

    return $result;
}

function runQueryParams($query, $query_params) {
    $result = pg_query_params($query, $query_params);

    if (!$result) {
        http_response_code(500);
        echo json_encode(array("error" => "Database query failed"));
        exit;
    }

    return $result;
}

?>
