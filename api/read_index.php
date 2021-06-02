<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$att = new Attendance($db);


$att->student_id = isset($_GET['id']) ? $_GET['id'] : die();
//return print_r('ad');
$result = $att->readByIndex();


$num = $att->count_all();


if ($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' => $id,
            'barcode_event' => $barcode_event,
            'day_date' => $day_date,
            'student_id' => $student_id,
            'student_name' => $student_name,
            'student_class' => $student_class,
            'timestamp' => $timestamp
        );

        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    echo json_encode(array('message' => 'Not found'));
}