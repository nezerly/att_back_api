<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$att = new Attendance($db);


//return print_r('ad');
$result = $att->allScanByStudents();

$num = $att->count();

//print_r($result->fetch(PDO::FETCH_ASSOC)); exit();
//return $result;

if ($num > 0) {
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'student_name' => $student_name,
            'student_id' => $student_id,
            'student_class' => $student_class,
//            'barcode_event' => $barcode_event,
            'timestamp' => $timestamp,
        );

        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    echo json_encode(array('message' => 'Not found'));
}
