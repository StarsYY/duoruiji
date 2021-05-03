<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>名家风采</title>
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
            <li><a class="current" href="#">名家风采</a></li>
            <li><a href="/review">往期视频</a></li>
        </ul>
    </div>
</div>
<div class="main">
    <div class="export">
        <div class="export_list clearfix">
            <?php $count = 1 ?>
            @foreach($experts as $v)
            <div class="export_ship @if($count % 3 == 0) mar_0 @endif">
                <div class="export_ship_img">
                    <a href="/expert/expert-info/{{$v->id}}"><img style="width: 110px; height: 100px" src="{{$v->portrait}}" /></a>
                </div>
                <div class="export_ship_txt">
                    <p>专家：{{$v->name}}</p>
                    <p>职位：{{$v->position}}</p>
                    <p>科室：{{$v->department}}</p>
                    <p>医院：{{$v->hospital}}</p>
                </div>
            </div>
            <?php $count++ ?>
            @endforeach
        </div>

        {{$experts->links()}}
    </div>
</div>
</body>
</html>
