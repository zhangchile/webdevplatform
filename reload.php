<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
require_once (ROOT . DS . 'core' . DS .'check.php');

if($_GET['time'] && $_GET['app']) {
    $sendTime = $_GET['time'];
    $app = $_GET['app'];
} else {
    return json_encode(array('status'=>0,'intime'=>time()-$sendTime));
} 

set_time_limit(0);//设定执行时间，0为无限
$startTime = time();//当前时间戳
$flag = false;
while(time() - $startTime < 50) {//60秒内检查文件是否改动
    if(is_change($app)) {
        $flag = true;
        break;
    }
    sleep(1);//间隔1秒检查
}
if($flag){
    echo json_encode(array('status'=>1,'intime'=>time()-$sendTime));  
} else {
    echo json_encode(array('status'=>0,'intime'=>time()-$sendTime));  
}