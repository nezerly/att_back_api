<?php


//print_r($_SERVER['DOCUMENT_ROOT']);
//print_r('DOCUMENT_SEPARATOR');

//
//
//defined('DS') ? null : define('DS', 'DIRECTORY_SEPARATOR');
//
defined('SERVER') ? null : define('SERVER', $_SERVER['DOCUMENT_ROOT']);

//
defined('SITE_ROOT') ? null : define('SITE_ROOT', SERVER.'/att_back_api');
//
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.'/'.'includes');

$includes = INC_PATH.'/config.php';
//
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.'/'.'core');
//print($includes);exit();
//
//
require_once($includes);
//
//
//require_once(CORE_PATH.'/'."post.php");
require_once(CORE_PATH.'/'."attendance.php");
require_once(CORE_PATH.'/'."student.php");
//
