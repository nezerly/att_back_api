<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//initializing our api
include_once('../core/initialize.php');

//instantiate post

$post = new Attendance($db);


//return print_r('ad');
$result = $post->read();

$num = $post->count_all();

$post_arr = array();
$post_arr['data'] = array();

array_push($post_arr['data'], $num);

echo json_encode($post_arr);