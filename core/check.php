<?php

function list_files()
{
	$dir = ROOT.DS.'WebApp'.DS;
	$dir_handle = opendir($dir);
	$dir_arr = array();
	while($file = readdir($dir_handle)) {
		if($file != '.' && $file != '..') {

		}
	}
}
