<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$student = new Student($db);


//return print_r('ad');
$result = $student->read();

$num = $student->count_all();


echo json_encode($num);