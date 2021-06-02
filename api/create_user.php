<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorisation, x-Requested-With');

//initializing our api
include_once('../core/initialize.php');

//instantiate post

/** @var PDO $db */

$student = new Student($db);

$data = json_decode(file_get_contents("php://input"));

$student->student_id = $data->student_id;
$student->student_name = $data->student_name;
$student->student_class = $data->student_class;

if ($student->create()) {
//    echo "working";exit();
    echo json_encode(
        array(
            'success' => 'User created'
        )
    );
} else {
    echo json_encode(
        array(
            'error' => 'Error, try again'
        )
    );
}