<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/needle.php';


if($_REQUEST['action'] === 'index'){
    sendJson(Needles::all());
} else if($_REQUEST['action'] === 'create') {
    $body_object = getJsonBody();
    $new_needle = new Needle(null, $body_object->size, $body_object->straight, $body_object->circular, $body_object->doublepoint);
    $all_needles = Needles::create($new_needle);

    sendJson($all_needles);
} else if($_REQUEST['action'] ==='update'){
    $body_object = getJsonBody();
    $updated_needle = new Needle($_REQUEST['id'], $body_object->size, $body_object->straight, $body_object->circular, $body_object->doublepoint);
    $all_needles = Needles::update($updated_needle);

    sendJson($all_needles);
} else if ($_REQUEST['action'] === 'delete'){
    $all_needles = Needles::delete($_REQUEST['id']);
    sendJson($all_needles);
}
 ?>
