<?php

header("Content-Type: application/json");

include_once __DIR__ . '/../models/random.php';


if($_REQUEST['action'] === 'index'){
    echo json_encode(Randoms::all());
} else if($_REQUEST['action'] === 'create') {
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $new_random = new Random(null, $body_object->name, $body_object->details, $body_object->box_number);
    $all_randoms = Randoms::create($new_random);

    echo json_encode($all_randoms);
} else if($_REQUEST['action'] ==='update'){
    $request_body = file_get_contents('php://input');
    $body_object = json_decode($request_body);
    $updated_random = new Random($_REQUEST['id'], $body_object->name, $body_object->details, $body_object->box_number);
    $all_randoms = Randoms::update($updated_random);

    echo json_encode($all_randoms);
} else if ($_REQUEST['action'] === 'delete'){
    $all_randoms = Randoms::delete($_REQUEST['id']);
    echo json_encode($all_randoms);
}
 ?>
