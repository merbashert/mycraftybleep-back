<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/zipper.php';


if($_REQUEST['action'] === 'index'){
    sendJson(Zippers::all());
} else if($_REQUEST['action'] === 'create') {
    $body_object = getJsonBody();
    $new_zipper = new Zipper(null, $body_object->size, $body_object->color);
    $all_zippers = Zippers::create($new_zipper);

    sendJson($all_zippers);
} else if($_REQUEST['action'] ==='update'){
    $body_object = getJsonBody();
    $updated_zipper = new Zipper($_REQUEST['id'], $body_object->size, $body_object->color);
    $all_zippers = Zippers::update($updated_zipper);

    sendJson($all_zippers);
} else if ($_REQUEST['action'] === 'delete'){
    $all_zippers = Zippers::delete($_REQUEST['id']);
    sendJson($all_zippers);
}
 ?>
