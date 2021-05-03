<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="/admin/css/bootstrap.css" rel="stylesheet">

    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/js/browser.js"></script>
    <script src="/admin/js/bootstrap.js"></script>
    <link href="/admin/css/custom.css" rel="stylesheet">

    <!-- 配置文件 -->
    <script type="text/javascript" src="/admin/js/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/admin/js/ueditor/ueditor.all.js"></script>
    <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
    <script type="text/javascript" src="/admin/js/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script src="/admin/js/ajaxfileupload.js"></script>

    <script src="/admin/js/adm.js"></script>

    <title>@yield('title')</title>

</head>

<body>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button data-target=".navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-sm">杨森多瑞吉管理后台</a>
        </div>
    </div>
    <div style="float:right;font-size:14px;">admin,欢迎您！<a href="/logout">退出</a>&nbsp;&nbsp;&nbsp;</div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="accordion" id="accordion-11">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" href="/adm">
                            首页
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" href="/adm/user">
                            用户管理
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" href="/adm/expert">
                            专家管理
                        </a>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" href="/adm/video">
                            直播/录播管理
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</div>
</body>

</html>