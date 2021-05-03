/**
 * 遮罩层
 */



//首页


//打开
function share_wx(){
    $.blockUI({ message: $(".chat_pop"), css:{border: 'none'} });
}


//关闭
function close_wx(){
    $.unblockUI();
}

function go_video(){
    $.blockUI({ message: $(".export_pop"), css:{border: 'none'} });
}



//看视频
function join_meeting(){
    var url = $("#geturl").val();
    var nick_name = $("#nick_name").val();
    url = url + "?nick_name=" + nick_name;
    window.open(url);
}