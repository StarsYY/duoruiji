<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>往期视频</title>
    <link href="/res/css/style.css" type="text/css" rel="stylesheet" />

    <link href="/admin/css/bootstrap.css" rel="stylesheet">

    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/js/browser.js"></script>
    <script src="/admin/js/bootstrap.js"></script>
    <link href="/admin/css/custom.css" rel="stylesheet">
</head>

<body>
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a href="/conf">名家讲堂</a></li>
            <li><a href="/expert">名家风采</a></li>
            <li><a class="current" href="#">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="past_video">
        <div class="past_video_list">
            <div class="one_line clearfix">
                <?php $count = 1 ?>
                @foreach($videos as $v)
                <div class="review_ship @if($count % 3 == 0) mar_0 @endif">
                    <div class="review_ship_img">
                        <a href="/review/review-info/{{$v->id}}">
                            <img width="255px" height="145px" src="{{$v->cover}}" />
                        </a>
                    </div>
                    <div class="review_ship_txt">
                        <div class="review_ship_title break"><a href="/review/review-info/{{$v->id}}">{{$v->title}}</a></div>
                        <div class="review_ship_intro clearfix">
                            <div class="review_ship_left">
                                <p>主持：<a href="/expert/expert-info/{{$v->expert_id}}">{{$v->name}}</a></p>
                                <p>日期：<span class="txt_999">{{$v->start_time}}</span></p>
                            </div>
                            <div class="review_ship_right">
                                <a class="info_btn" href="/review/review-info/{{$v->id}}">查看详情</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $count++ ?>
                @endforeach
            </div>
        </div>

        {{$videos->links()}}
    </div>
</div>
</body>
</html>
