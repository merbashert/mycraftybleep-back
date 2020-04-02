<?php

header("Content-Type: application/json");

include_once __DIR__ . '/../models/zipper.php';


if($_REQUEST['action'] === 'index'){
    echo json_encode(Zippers::all());
} else if($_REQUEST['action'] === 'create') {
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_zipper = new Zipper(null, $body_object->size, $body_object->color);
    $all_zippers = Zippers::create($new_zipper);

    echo json_encode($all_zippers);
} else if($_REQUEST['action'] ==='update'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_zipper = new Zipper($_REQUEST['id'], $body_object->size, $body_object->color);
    $all_zippers = Zippers::update($updated_zipper);

    echo json_encode($all_zippers);
} else if ($_REQUEST['action'] === 'delete'){
    $all_zippers = Zippers::delete($_REQUEST['id']);
    echo json_encode($all_zippers);
}
 ?>
