@extends('layout.common')
@section('title', '直播/录播管理')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12" id="content">
        <div class="app_content_div" id="app_content_div_301Index">
            <h3>直播/录播列表</h3>
            <div style="float: right">
                <form action="/adm/video">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <span style="display: -moz-inline-block; display: inline-block; width: 200px">
                    <input value="@if(isset($search)){{$search}}@endif" type="text" id="search" name="search" class="form-control mr-sm-2" style="width: 200px" placeholder="Search">
                </span>
                <span><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></span>
                </form>
            </div>
        </div>

        <br><button type="button" class="btn btn-primary" onclick="window.location.href='/adm/video/add-video'">新增视频</button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>标题</th>
                <th>科室</th>
                <th>专家</th>
                <th>类型</th>
                <th>直播开始时间</th>
                <th>直播结束时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <form>
            @foreach($videos as $v)
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <tr>
                <th scope="row">{{$v->id}}</th>
                <td>{{$v->title}}</td>
                <td>{{$v->department}}</td>
                <td>{{$v->name}}</td>
                <td>@if($v->type)录播@else直播@endif</td>
                <td>{{$v->start_time}}</td>
                <td>{{$v->end_time}}</td>
                <td>
                    <a href="/adm/video/edit-video/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp;&nbsp;&nbsp;
                    <a onclick="delvideo({{$v->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
            @endforeach
            </form>
            </tbody>
        </table>

        {{$videos->appends(array('search' => $search))->links()}}

        <script>
            function delvideo(id){
                var mymessage = confirm("确定删除该记录么？");
                if (mymessage) {
                    data = {
                        'id': id,
                        '_token': $("#_token").val()
                    };
                    $.post('/adm/video/del-video', data, function (data) {
                        if (data.success) {
                            location.href = "/adm/video";
                        } else {
                            alert(data.msg);
                        }
                    }, 'json');
                }
            }
        </script>

    </div>
</div>
@endsection