<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>往期视频-详情</title>
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <link href="/res/css/style.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/ckplayer_video/ckplayer.js"></script>
</head>
<body>
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a href="/conf">名家讲堂</a></li>
            <li><a href="/expert">名家风采</a></li>
            <li><a class="current" href="/review">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="past_top clearfix">
        <div class="past_left">
            <div class="past_left_title">{{$video->title}}</div>
{{--            <div class="past_left_video" id="videoinfo">--}}
                <video src="{{$video->url}}" height="320px" controls preload></video>
{{--            </div>--}}
            {{--<script type="text/javascript">
                var flashvars = {
                    f: '{{$video->url}}',
                    c: 0,
                    p: 2,
                    b: 1
                };
                var video = ['{{$video->url}}'];
                CKobject.embed('ckplayer_video/ckplayer.swf','videoinfo','ckplayer_a1','548','329',false,flashvars,video);
            </script>--}}
            <div class="online_class_share">
                <span>分享到：</span>
                <a href="javascript:void(0)"><img src="/res/images/icon_weixin.jpg" /></a>
            </div>
        </div>
        <div class="past_right">
            <div class="past_intro">
                <div class="title_box">本期简介</div>
                <div class="past_intro_body">
                    <p>{{$video->course}}</p>
                </div>
            </div>
            <div class="past_other">
                <div class="past_other_title">其他讲堂</div>
                <div class="past_other_list">
                    <div class="past_other_ship">
                        @if(isset($videos) && $videos->id != $video->id)
                        <a href="/review/review-info/{{$videos->id}}"><img src="{{$videos->cover}}" /></a><br/>
                        <a href="/review/review-info/{{$videos->id}}"><p style="text-align: right">{{$videos->title}}</p></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="past_export">
        <div class="title_box">本期嘉宾</div>
        <div class="export_this_list">
            @foreach($experts as $v)
            <div class="export_this_ship clearfix">
                <div class="left_export"><img src="{{$v->portrait}}" /></div>
                <div class="right_export">
                    <div class="export_base">
                        <p class="name">{{$v->name}}</p>
                        <p><b>科室：{{$v->department}}</b></p>
                        <p><b>职称：{{$v->title}}</b></p>
                    </div>
                    <div class="export_this_intro">
                        <p>{{$v->introduction}}</p>
                        <div class="export_edu clearfix">
                            <div class="edu_title">接受教育：</div>
                            <div class="edu_info">
                                <p>{{$v->edu}}</p>
                                <p><a href="/expert/expert-info/{{$v->id}}">【详情】</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
