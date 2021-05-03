<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>名家风采-详情</title>
    <link href="/res/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div class="head">
    <div class="nav">
        <ul class="nav_body">
            <li><a href="/">首页</a></li>
            <li><a href="/conf">名家讲堂</a></li>
            <li><a class="current" href="/expert">名家风采</a></li>
            <li><a href="/review">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="export_info">
        <div class="export_this">
            <div class="title_box">本期嘉宾</div>
            <div class="export_this_body clearfix">
                <div class="left_export"><img src="{{$expert->portrait}}" /></div>
                <div class="right_export">
                    <div class="export_base">
                        <p class="name">{{$expert->name}}</p>
                        <p><b>科室：</b>{{$expert->department}}</p>
                        <p><b>职称：</b>{{$expert->title}}</p>
                    </div>
                    <div class="export_this_intro">
                        <p>{{$expert->introduction}}</p>
                        <div class="export_edu clearfix">
                            <div class="edu_title">接受教育：</div>
                            <div class="edu_info">
                                <p>{{$expert->edu}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="this_intro">
            <div class="title_box">本期简介</div>
            <div class="this_intro_body">
                @if(isset($course))<p class="te_2">{{$course}}</p>@endif
            </div>
        </div>
        <div class="other_export">
            <div class="title_box">其他专家</div>
            <div class="export_list clearfix">
                <?php $count = 1 ?>
                @if(isset($experts))@foreach($experts as $v)@if($v->name != $expert->name)
                <div class="export_ship @if($count % 3 == 0) mar_0 @endif">
                    <div class="export_ship_img">
                        <a href="#"><img src="{{$v->portrait}}" /></a>
                    </div>
                    <div class="export_ship_txt">
                        <p>专家：{{$v->name}}</p>
                        <p>职位：{{$v->position}}</p>
                        <p>科室：{{$v->department}}</p>
                        <p>医院：{{$v->hospital}}</p>
                    </div>
                </div>
                <?php $count++ ?>
                @endif@endforeach@endif
            </div>
        </div>
    </div>
</div>
</body>
</html>
