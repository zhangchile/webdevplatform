<?php

function get_allfiles($path,&$files) {
    if(is_dir($path)){
        $dp = opendir($path);
        while ($file = readdir($dp)){
            if($file !="." && $file !=".."){
                get_allfiles($path.DS.$file, $files);
            }
        }
        closedir($dp);
    }
    if(is_file($path)){
        // echo substr($path, stripos($path,'WebApp') + 7).'<br/>';
        $files[] =  substr($path, stripos($path,'WebApp') + 7);
    }
}
   
function get_filenamesbydir($dir){
    $files =  array();
    get_allfiles($dir,$files);
    return $files;
}

function print_files($dir) {
    $filenames = get_filenamesbydir($dir);
    //打印所有文件名，包括路径
    foreach ($filenames as $value) {
        // echo $value .'  md5 = '. md5_file($value) ."<br />";
    }
}

function log_file($dir, $app)
{
    $filenames = get_filenamesbydir($dir);
    $info = array();
    foreach ($filenames as $value) {
        array_push($info, array('dir'=>$value, 'md5'=>md5_file(ROOT.DS.'WebApp'.DS.$value)));
    }
    // var_dump($file_info);
    $file_info = json_encode($info);
    $handle = fopen('data/'.$app.'.json','w');
    if(!$handle) die('不能打开文件！');
    fwrite($handle, $file_info);
    fclose($handle);
}

function is_change($app)
{
    $dir = ROOT.DS.'WebApp'.DS.$app;

    if(!file_exists('data/'.$app.'.json')) {//文件不存在
        log_file($dir, $app);//创建一个新的记录
        return true;
    }

    $files = get_filenamesbydir($dir);
    $info = array();
    foreach ($files as $value) {
        array_push($info, array('dir'=>$value, 'md5'=>md5_file(ROOT.DS.'WebApp'.DS.$value)));
    }
    $file_info = json_encode($info);
    $handle = fopen('data/'.$app.'.json','r');
    if(!$handle) die('不能打开文件！');
    $content = fgets($handle);
    fclose($handle);
    // var_dump($file_info,$content);
    if(!strcmp($file_info, $content)) {//比较文件信息
        // echo 'no change';
        return false;
    } else {
        // echo 'had changed';
        log_file($dir, $app);
        return true;
    }
}