<?php

require_once (ROOT . DS . 'config' . DS .'config.php');
require_once (ROOT . DS . 'core' . DS .'check.php');

function callHook()
{
	global $url;
	
	$urlArray = array();
	$urlArray = explode("/", $url);
	echo '<br/>';
	var_dump($urlArray);
	if($urlArray[0] != '') {
		$app = $urlArray[0];
	 } else {
		$app = "default";//默认为default
	 }
	array_shift($urlArray);//将数组开头的单元移出数组
	if(count($urlArray) != 0) {
		$page = $urlArray[0];     
	} else {
		$page = "index.html";//默认为index.html
	 }
	array_shift($urlArray);

	if(file_exists(ROOT.DS.'WebApp'.DS.$app.DS.$page)) {
		include(ROOT.DS.'WebApp'.DS.$app.DS.$page);
		include (ROOT.DS.'core'.DS.'Ajax.php');
	} else {
		//show file not find
		echo "<h1>No such file or dirrectory</h1>";
	}
}

callHook();
print_files(ROOT.DS.'WebApp');
//log_file(ROOT.DS.'WebApp', 'default');
is_change('default');