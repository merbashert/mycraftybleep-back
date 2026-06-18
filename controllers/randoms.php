<?php

require_once __DIR__ . '/../config/api.php';
include_once __DIR__ . '/../models/random.php';

$action = getAction();

if($action === 'index'){
    sendJson(Randoms::all());
} else if($action === 'create') {
    $body_object = getJsonBody();
    $new_random = new Random(null, getBodyValue($body_object, 'name'), getBodyValue($body_object, 'details'), getBodyValue($body_object, 'box_number'));
    $all_randoms = Randoms::create($new_random);

    sendJson($all_randoms);
} else if($action ==='update'){
    $body_object = getJsonBody();
    $updated_random = new Random(getId(), getBodyValue($body_object, 'name'), getBodyValue($body_object, 'details'), getBodyValue($body_object, 'box_number'));
    $all_randoms = Randoms::update($updated_random);

    sendJson($all_randoms);
} else if ($action === 'delete'){
    $all_randoms = Randoms::delete(getId());
    sendJson($all_randoms);
} else {
    sendError("Unknown action", 400);
}
 ?>
