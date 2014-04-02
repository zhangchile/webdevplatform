<script type="text/javascript">
function getT(){
    var D = new Date();
    var t = String(D.getTime());
    t = Number(t.substr(0, 10));
    return t;
}
function poll(t){
    $.ajax({
        type: "GET",
        url: <?php $request_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; 
                echo '"'.substr($request_url, 0, stripos($request_url,'index.php')).'reload.php"';?>,
        data: {time:t},
        async: true,
        timeout: 60*1000,//60秒后服务器没有返回就重新发起
        success: function(msg){
            (typeof msg !== 'object') ? jsonObj = JSON.parse(msg) :  jsonObj = msg ;
            if (1 === jsonObj.status){
                // alert("有新消息！"+msg.data);
                console.log("文件已经改动，可以刷新页面！");
                poll(getT());
                window.location.reload();//刷新页面
            } else {
                console.log("没有任何改动！再次建立查询...");
                console.log("msg=" + jsonObj.status + ",intime = "+ jsonObj.intime+"s");
                poll(getT());
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown){
            if("timeout" === textStatus){
                // alert("超时啦！");
                console.log("等待超时，重新连接中...");
                poll(getT());
            }
        }
    }, "JSON");
}
$(function(){
    poll(getT());

});
</script>
</script>