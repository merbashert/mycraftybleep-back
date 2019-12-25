<?php

header("Content-Type: application/json");

include_once __DIR__ . '/../models/needle.php';


if($_REQUEST['action'] === 'index'){
    echo json_encode(Needles::all());
} else if($_REQUEST['action'] === 'create') {
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_needle = new Needle(null, $body_object->size, $body_object->straight, $body_object->circular, $body_object->doublepoint);
    $all_needles = Needles::create($new_needle);

    echo json_encode($all_needles);
} else if($_REQUEST['action'] ==='update'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_needle = new Needle($_REQUEST['id'], $body_object->size, $body_object->straight, $body_object->circular, $body_object->doublepoint);
    $all_needles = Needles::update($updated_needle);

    echo json_encode($all_needles);
} else if ($_REQUEST['action'] === 'delete'){
    $all_needles = Needles::delete($_REQUEST['id']);
    echo json_encode($all_needles);
}
 ?>
