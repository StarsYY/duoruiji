@extends('layout.common')
@section('title', '编辑视频')
@section('content')
    @if(count($errors)>0)
        <script>alert({{$errors}})</script>
    @endif
<link href="/admin/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
<script src="/admin/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/admin/js/bootstrap-datetimepicker.zh-CN.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $(".ui_timepicker").datetimepicker({
            format: 'yyyy-mm-dd hh:ii:ss',
            language:'zh-CN',
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
        })
    })
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12" id="content">
        <div class="app_content_div" id="app_content_div_301Index">
            <h3>编辑视频</h3>
        </div>
        <form action="/adm/video/edit-video" method="post" class="form-horizontal">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <input type="hidden" id="id" name="id" value="{{$video->id}}">

            <div class="form-group">
                <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span>视频标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label"><span style="color:red;">*</span>视频路径</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="url" name="url" value="{{$video->url}}">
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label"><span style="color:red;">*</span>视频类型</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="type" id="type" value="1" @if($video->type)checked@endif> 录播
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type" id="type" value="0" @if(!($video->type))checked@endif> 直播
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="course" class="col-sm-2 control-label"><span style="color:red;">*</span>课程简介</label>
                <div class="col-sm-10">
                    <script type="text/plain" id="course" name="course">{{$video->course}}</script>
                    <script type="text/javascript">
                        var editor = UE.getEditor('course')
                    </script>
                </div>
            </div>
            <div class="form-group">
                <label for="start_time" class="col-sm-2 control-label"><span style="color:red;">*</span>开始时间</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control ui_timepicker" id="start_time" name="start_time" value="{{$video->start_time}}" >
                </div>
            </div>
            <div class="form-group">
                <label for="end_time" class="col-sm-2 control-label"><span style="color:red;">*</span>结束时间</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control ui_timepicker" id="end_time" name="end_time" value="{{$video->end_time}}">
                </div>
            </div>
            <div class="form-group">
                <label for="cover" class="col-sm-2 control-label"><span style="color:red;">*</span>封面</label>
                <div class="col-sm-10">
                    <input type="file" id="upload_file" name="upload_file" onchange="saveThumbToVideo()"/>
                    <input type="hidden" class="form-control" id="photo" name="photo" value="{{$video->cover}}" >
                    <img style="width: 320px; height: 200px;" id="thumb" src="{{$video->cover}}" />
                </div>
            </div>
            <div class="form-group">
                <label for="expertlist" class="col-sm-2 control-label"><span style="color:red;">*</span>关联专家</label>
                <div class="col-sm-10">
                    <select id="expert">
                        <option value="">请选择</option>
                        @foreach($experts as $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-default" type="button" onclick="experttovideo()">添加</button>
                    <style>
                        .expert{margin:5px;}
                    </style>
                    <div id="expertlist" name="expertlist">
                        @foreach($addexperts as $v)
                            <div>
                                <input type="hidden" value="{{$v->id}}" name="doc_id[]">
                                <span class="expert">{{$v->name}}</span>
                                <span class="glyphicon glyphicon-remove mouse" onclick="$(this).parent().remove()"></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">确定</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection