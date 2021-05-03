$(function () {
    timego(); //防止刷新会有空白
    var timer = setInterval(timego, 1000);

    function timego() {
        var time = $("#start_time").val();
        var nowTime = new Date();
        var inputTime = new Date(time);
        var times = ((inputTime - nowTime) / 1000);

        var dif = inputTime - nowTime;
        if (dif < 0) {
            clearInterval(timer);
            $(".before").hide();
            $(".meeting").show();
            return false;
        }

        var d = parseInt(times / 60 / 60 / 24);
        var h = parseInt(times / 60 / 60 % 24);
        h = h < 10 ? "0" + h : h;
        var m = parseInt(times / 60 % 60);
        m = m < 10 ? "0" + m : m;
        var s = parseInt(times % 60);
        s = s < 10 ? "0" + s : s;
        $(".time1").html(d);
        $(".time2").html(h);
        $(".time3").html(m);
        $(".time4").html(s);
    }
});

$(function () {
    timeend(); //防止刷新会有空白
    var timer = setInterval(timeend, 1000);
    function timeend() {
        var time = $("#end_time").val();
        var nowTime = new Date();
        var inputTime = new Date(time);
        var times = ((inputTime - nowTime) / 1000);
        var dif = inputTime - nowTime;

        if (dif < 0) {
            clearInterval(timer);
            $(".before").hide();
            $(".meeting").hide();
            $(".online_export_box").hide();
            $("#imgID").attr('src','/res/images/last_time_bg.jpg');
            // $(".end_title").show();

            data = {
                'id': $("#id").val(),
                '_token': $("#_token").val()
            };
            $.post('/conf/change', data, function (data) {
                if (data.success) {
                    location.reload();
                } else {
                    alert("有错了");
                }
            }, 'json');

            return false;
        }
    }
})