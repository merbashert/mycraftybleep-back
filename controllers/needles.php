<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/needle.php';

$action = getAction();

if($action === 'index'){
    sendJson(Needles::all());
} else if($action === 'create') {
    $body_object = getJsonBody();
    $new_needle = new Needle(null, $body_object->size, $body_object->straight, $body_object->circular, $body_object->doublepoint);
    $all_needles = Needles::create($new_needle);

    sendJson($all_needles);
} else if($action ==='update'){
    $body_object = getJsonBody();
    $updated_needle = new Needle(getId(), $body_object->size, $body_object->straight, $body_object->circular, $body_object->doublepoint);
    $all_needles = Needles::update($updated_needle);

    sendJson($all_needles);
} else if ($action === 'delete'){
    $all_needles = Needles::delete(getId());
    sendJson($all_needles);
} else {
    sendError("Unknown action", 400);
}
 ?>
