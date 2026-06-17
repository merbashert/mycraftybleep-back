<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/random.php';


if($_REQUEST['action'] === 'index'){
    sendJson(Randoms::all());
} else if($_REQUEST['action'] === 'create') {
    $body_object = getJsonBody();
    $new_random = new Random(null, $body_object->name, $body_object->details, $body_object->box_number);
    $all_randoms = Randoms::create($new_random);

    sendJson($all_randoms);
} else if($_REQUEST['action'] ==='update'){
    $body_object = getJsonBody();
    $updated_random = new Random($_REQUEST['id'], $body_object->name, $body_object->details, $body_object->box_number);
    $all_randoms = Randoms::update($updated_random);

    sendJson($all_randoms);
} else if ($_REQUEST['action'] === 'delete'){
    $all_randoms = Randoms::delete($_REQUEST['id']);
    sendJson($all_randoms);
}
 ?>
