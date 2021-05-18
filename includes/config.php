<?php
$db_user = "root";
$db_password = "";

$db_name = "phprest";

$db = new PDO('mysql:host=localhost;dbname=phprest;charset=utf8', $db_user, $db_password);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::  ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::  MYSQL_ATTR_USE_BUFFERED_QUERY, true);

define('APP_NAME', 'ABMTC ATTENDANCE API');

