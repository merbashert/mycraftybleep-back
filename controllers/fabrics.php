<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/fabric.php';


if($_REQUEST['action'] === 'index'){
    sendJson(Fabrics::all());
} else if($_REQUEST['action'] === 'create') {
    $body_object = getJsonBody();
    $new_fabric = new Fabric(null, $body_object->length, $body_object->tags, $body_object->main_color, $body_object->picture);
    $all_fabrics = Fabrics::create($new_fabric);

    sendJson($all_fabrics);
} else if($_REQUEST['action'] ==='update'){
    $body_object = getJsonBody();
    $updated_fabric = new Fabric($_REQUEST['id'], $body_object->length, $body_object->tags, $body_object->main_color, $body_object->picture);
    $all_fabrics = Fabrics::update($updated_fabric);

    sendJson($all_fabrics);
} else if ($_REQUEST['action'] === 'delete'){
    $all_fabrics = Fabrics::delete($_REQUEST['id']);
    sendJson($all_fabrics);
}
 ?>
