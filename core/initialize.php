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
//
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.'/'.'core');
//
//
require_once(INC_PATH.'/'."config.php");
//
//
require_once(CORE_PATH.'/'."post.php");
//
