<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/zipper.php';

$action = getAction();

if($action === 'index'){
    sendJson(Zippers::all());
} else if($action === 'create') {
    $body_object = getJsonBody();
    $new_zipper = new Zipper(null, $body_object->size, $body_object->color);
    $all_zippers = Zippers::create($new_zipper);

    sendJson($all_zippers);
} else if($action ==='update'){
    $body_object = getJsonBody();
    $updated_zipper = new Zipper(getId(), $body_object->size, $body_object->color);
    $all_zippers = Zippers::update($updated_zipper);

    sendJson($all_zippers);
} else if ($action === 'delete'){
    $all_zippers = Zippers::delete(getId());
    sendJson($all_zippers);
} else {
    sendError("Unknown action", 400);
}
 ?>
