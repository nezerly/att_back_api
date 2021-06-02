<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$att = new Attendance($db);


date_default_timezone_set('GMT');
$tdate = date("Y-m-d");

$att->day_date = $tdate;

//return print_r($tdate);

$result = $att->readByDate();


$total = $att->countByDate();

echo json_encode($total);