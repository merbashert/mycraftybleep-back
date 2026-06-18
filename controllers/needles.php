<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/needle.php';

$action = getAction();

if($action === 'index'){
    sendJson(Needles::all());
} else if($action === 'create') {
    $body_object = getJsonBody();
    $new_needle = new Needle(null, getBodyValue($body_object, 'size'), getBodyValue($body_object, 'straight'), getBodyValue($body_object, 'circular'), getBodyValue($body_object, 'doublepoint'));
    $all_needles = Needles::create($new_needle);

    sendJson($all_needles);
} else if($action ==='update'){
    $body_object = getJsonBody();
    $updated_needle = new Needle(getId(), getBodyValue($body_object, 'size'), getBodyValue($body_object, 'straight'), getBodyValue($body_object, 'circular'), getBodyValue($body_object, 'doublepoint'));
    $all_needles = Needles::update($updated_needle);

    sendJson($all_needles);
} else if ($action === 'delete'){
    $all_needles = Needles::delete(getId());
    sendJson($all_needles);
} else {
    sendError("Unknown action", 400);
}
 ?>
