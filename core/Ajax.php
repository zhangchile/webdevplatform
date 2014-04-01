<script type="text/javascript">
    var div = document.createElement('div');
    document.body.appendChild(div);
    function time(){
        var date = new Date();
        div.innerHTML = date.getHours() +' : ' + date.getMinutes() +' : ' + date.getSeconds();
        setTimeout(time,900);
    }
    time();
</script>