<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>名家讲堂</title>
    <link href="/res/css/style.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/res/js/countdown.js"></script>
    <script type="text/javascript" src="/res/js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="/res/js/share.js"></script>
</head>

<body>
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a class="current" href="#">名家讲堂</a></li>
            <li><a href="/expert">名家风采</a></li>
            <li><a href="/review">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="online">
        <div class="online_class">
            <div class="online_class_bg">
                @if(isset($start_video))
                    <img id="imgID" src="{{$start_video->cover}}" />
                @else
                    <img id="imgID" src="/res/images/last_time_bg.jpg" />
                @endif
            </div>
            <div class="online_class_body">
                @if(isset($start_video))
                <div class="before">
                    <div class="last_time_big">
                        <form>
                            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                            <input type="text" id="id" value="{{$start_video->id}}" hidden/>
                        </form>
                        <input type="text" id="start_time" value="{{$start_video->start_time}}" hidden/>
                        <input type="text" id="end_time" value="{{$start_video->end_time}}" hidden/>

                        <span class="time1">00</span>
                        <span class="time2">00</span>
                        <span class="time3">00</span>
                        <span class="time4">00</span>
                    </div>
                    <a class="class_href" href="javascript:void(0)"></a>
                </div>
                @endif
                <!--会议进行中-->
                @if(isset($start_video))
                <div class="meeting" style="display: none;">
                    <input type="hidden" id="geturl" value="{{$start_video->url}}"/>
                    <a href="javascript:void(0)" onclick="go_video()">
                        <img src="/res/images/online_classing.png" />
                    </a>
                </div>
                @endif
                <!--会议结束-->
                <div class="end_title" @if(isset($start_video))style="display: none;"@endif>会议已结束</div>

                @if(isset($start_video))
                <div class="online_export_box">
                    <div class="online_export_bg"></div>
                    <div class="online_export clearfix">
                        @if(isset($expert))
                        <div class="online_export_ship">
                            <div class="online_export_img">
                                <a href="/expert/expert-info/{{$expert->id}}"><img src="{{$expert->portrait}}" /></a>
                            </div>
                            <div class="online_export_txt">
                                <p>专家：{{$expert->name}}</p>
                                <p>医院：{{$expert->hospital}}</p>
                                <p>科室：{{$expert->department}}</p>
                                <p>职称：{{$expert->title}}</p>
                            </div>
                        </div>
                        @endif
                        <!--课程简介-->
                        <div class="online_export_ship border_left">
                            <div class="online_export_intro">
                                <p><b>课程简介</b></p>
                                <p>{{$start_video->course}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(isset($start_video))
        <div class="online_class_share">
            <span>分享到：</span>
            <a href="javascript:void(0)" onclick="share_wx()"><img src="/res/images/icon_weixin.jpg" /></a>
        </div>
        @endif
    </div>
</div>

<!--微信分享弹窗-->
<div class="chat_pop" style="display:none">
    <div class="chat_pop_top"><a href="javascript:void(0)" onclick="close_wx()" class="chat_pop_close"></a></div>
    <div class="chat_pop_body">
        <img src="{{$url}}" />
        <p>使用微信扫一扫，并将网页分享给好友</p>
    </div>
</div>

<!-- 姓名输入弹出框 -->
<div id="name_pop" class="export_pop" style="display:none">
    <div class="export_pop_top">
        <span>提示</span>
        <a href="javascript:void(0)" onclick="close_wx()" class="export_pop_close"></a>
    </div>
    <div class="export_pop_body">
        <div>请输入您的姓名：</div>
        <div class="export_name_input"><input id="nick_name" type="text" /></div>
        <div class="export_name_submit"><input type="button" class="btn blue_btn" value="确定" onclick="join_meeting()"/></div>
    </div>
</div>
</body>
</html>
