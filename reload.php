<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
require_once (ROOT . DS . 'core' . DS .'bootstrap.php');
$callHook = callHook();
set_time_limit(0);//设定执行时间，0为无限
$startTime = time();//当前时间戳
$flag = false;
while(time() - $startTime < 60) {//60秒内检查文件是否改动
    if(is_change($callHook['app'])) {
        $flag = true;
        break;
    }
    sleep(1);//间隔1秒检查
}
// sleep(rand(1,10));
if($flag){
    $sendTime = $_GET['time'];
    echo json_encode(array('status'=>1,'intime'=>time()-$sendTime));  
} else {
    $sendTime = $_GET['time'];
    echo json_encode(array('status'=>0,'intime'=>time()-$sendTime));  
}