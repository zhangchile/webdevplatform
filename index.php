<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

$uri = $_SERVER['REQUEST_URI'];
$start = stripos($uri, 'index.php');
if($start > 0)
	$url = substr($uri, $start + 10);
else
	$url = '';

require_once(ROOT . DS. 'core' . DS . 'bootstrap.php');
