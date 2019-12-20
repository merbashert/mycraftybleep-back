<?php

header("Content-Type: application/json");

include_once __DIR__ . '/../models/fabric.php';


if($_REQUEST['action'] === 'index'){
    echo json_encode(Fabrics::all());
} else if($_REQUEST['action'] === 'create') {
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_fabric = new Fabric(null, $body_object->length, $body_object->tags, $body_object->main_color, $body_object->picture);
    $all_fabrics = Fabrics::create($new_fabric);

    echo json_encode($all_fabrics);
} else if($_REQUEST['action'] ==='update'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_fabric = new Fabric($_REQUEST['id'], $body_object->length, $body_object->tags, $body_object->main_color, $body_object->picture);
    $all_fabrics = Fabrics::update($updated_fabric);

    echo json_encode($all_fabrics);
} else if ($_REQUEST['action'] === 'delete'){
    $all_fabrics = Fabrics::delete($_REQUEST['id']);
    echo json_encode($all_fabrics);
}
 ?>
