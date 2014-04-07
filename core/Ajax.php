<script type="text/javascript">
var autoReload = function() {
    var request = null;
    var timeOut = 60*1000;//60s超时
    var timeID;
    function getT(){
        var D = new Date();
        var t = String(D.getTime());
        t = Number(t.substr(0, 10));
        return t;
    }

    function createRequest() {
        if(window.XMLHttpRequest) {
            request = new XMLHttpRequest();
        } else if(window.ActiveXobject){
            try {
                request = new ActiveXObject("Microsoft.XMLHttp");
            } catch(e) {
                request = null;
            }
        }
        if(request == null)
            alert('你的浏览器不支持异步请求！');
    }

    function sendRequest() {
        createRequest();
        var url = <?php $request_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; 
                    echo '"'.substr($request_url, 0, stripos($request_url,'index.php')).'reload.php"';?>;
        var app = "<?php global $app; echo $app;?>";
        request.open('GET',url + '?time=' + getT() + '&app=' + app,true);
        request.onreadystatechange = processRequest;
        request.send(null);
        timeID = setTimeout(abortRequest, timeOut);//超时重试
    }

    function processRequest() {
        if(request.readyState == 4 && request.status == 200) {
            //请求结果已经返回
            var msg = request.responseText;
            // console.log(msg);
            (typeof msg !== 'object') ? jsonObj = JSON.parse(msg) : jsonObj = msg;
            if (1 === jsonObj.status){
                console.log("文件已经改动，可以刷新页面！");
                window.location.reload();//刷新页面
            } else {
                console.log("没有任何改动！再次建立查询...");
                console.log("msg=" + jsonObj.status + ",intime = "+ jsonObj.intime+"s");
                clearTimeout(timeID);//清除计时器
                sendRequest();
            }
        }
    }
    function abortRequest() {
        console.log('查询超时！重新开始查询...');
        request.abort();
        sendRequest();
    }
    this.start = function() {//开始执行
        sendRequest();
    }
}

window.onload = (new autoReload()).start();
</script>