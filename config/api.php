<?php

header("Content-Type: application/json");

function getJsonBody() {
    $request_body = file_get_contents('php://input');
    return json_decode($request_body);
}

function sendJson($data) {
    echo json_encode($data);
}

?>
