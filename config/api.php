<?php

header("Content-Type: application/json");

function getJsonBody() {
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);

    if (!$body_object) {
        sendError("Invalid JSON body", 400);
    }

    return $body_object;
}

function sendJson($data) {
    echo json_encode($data);
}

function getAction() {
    if (!isset($_REQUEST['action'])) {
        sendError("Missing action", 400);
    }

    return $_REQUEST['action'];
}

function getId() {
    if (!isset($_REQUEST['id'])) {
        sendError("Missing id", 400);
    }

    return $_REQUEST['id'];
}

function getBodyValue($body_object, $fieldName) {
    if (!isset($body_object->$fieldName)) {
        sendError("Missing ".$fieldName, 400);
    }

    return $body_object->$fieldName;
}

function sendError($message, $statusCode) {
    http_response_code($statusCode);
    sendJson(array("error" => $message));
    exit;
}

?>
