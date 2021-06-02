<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$post = new Student($db);


//return print_r('ad');
$result = $post->read();

$num = $post->count_all();


if ($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' => $id,
            'student_id' => $student_id,
            'student_name' => $student_name,
            'student_class' => $student_class,
            'created_at' => $created_at
        );

        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    echo json_encode(array('message' => 'Not found'));
}