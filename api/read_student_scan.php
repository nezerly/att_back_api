<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$att = new Attendance($db);


$att->student_id = isset($_GET['student_id']) ? $_GET['student_id'] : die();
//return print_r('ad');
$result = $att->scanByStudent();

$num = $att->count();

//return $result;

if ($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'barcode_event' => $barcode_event,
            'student_id' => $student_id,
            'timestamp' => $timestamp,
            'student_name' => $student_name,
            'student_class' => $student_class
        );

        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    echo json_encode(array('message' => 'Not found'));
}
