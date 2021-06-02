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


if ($total > 0) {

    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' => $id,
            'barcode_event' => $barcode_event,
            'day_date' => $day_date,
            'student_id' => $student_id,
            'timestamp' => $timestamp
        );

        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
} else {
    echo json_encode(array('message' => 'Not found'));
}