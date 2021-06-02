<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorisation, x-Requested-With');

//initializing our api
include_once('../core/initialize.php');

//instantiate post

$attendance = new Attendance($db);

$data = json_decode(file_get_contents("php://input"));

$attendance->barcode_event = $data->barcode_event;
//$attendance->day_date = $data->day_date;
$attendance->student_id = $data->student_id;
$attendance->student_name = $data->student_name;
$attendance->student_class = $data->student_class;

if ($attendance->create()){
//    echo "working";exit();
    echo json_encode(
      array(
          'message' => 'attendance submitted'
      )
    );
} else {
    echo json_encode(
        array(
            'message' => 'attendance not submitted'
        )
    );
}