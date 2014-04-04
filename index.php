<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

// echo substr($_SERVER['REQUEST_URI'], 0, stripos($_SERVER['REQUEST_URI'],'index.php')),$_SERVER['REQUEST_URI'];
$url = '';//全局变量
$app = '';
$page = '';

require_once(ROOT . DS. 'core' . DS . 'bootstrap.php');
rander();//加载页面