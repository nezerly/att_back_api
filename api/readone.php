<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$att = new Attendance($db);


//return print_r('ad');
$result = $att->read();

$att->id = isset($_GET['id']) ? $_GET['id'] : die();

$att->read_one();

$att_arr = array(
    'id' => $att->id,
    'barcode_event' => $att->barcode_event,
    'day_date' => $att->day_date,
    'student_id' => $att->student_id,
    'student_name' => $att->student_name,
    'student_class' => $att->student_class,
    'timestamp' => $att->timestamp,
);

print_r(json_encode($att_arr));