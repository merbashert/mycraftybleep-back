<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/fabric.php';

$action = getAction();

if($action === 'index'){
    sendJson(Fabrics::all());
} else if($action === 'create') {
    $body_object = getJsonBody();
    $new_fabric = new Fabric(null, $body_object->length, $body_object->tags, $body_object->main_color, $body_object->picture);
    $all_fabrics = Fabrics::create($new_fabric);

    sendJson($all_fabrics);
} else if($action ==='update'){
    $body_object = getJsonBody();
    $updated_fabric = new Fabric(getId(), $body_object->length, $body_object->tags, $body_object->main_color, $body_object->picture);
    $all_fabrics = Fabrics::update($updated_fabric);

    sendJson($all_fabrics);
} else if ($action === 'delete'){
    $all_fabrics = Fabrics::delete(getId());
    sendJson($all_fabrics);
} else {
    sendError("Unknown action", 400);
}
 ?>
