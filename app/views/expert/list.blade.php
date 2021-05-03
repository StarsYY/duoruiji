@extends('layout.common')
@section('title', '专家管理')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12" id="content">
        <div class="app_content_div" id="app_content_div_301Index">
            <h3>专家列表</h3>
            <div style="float: right">
                <form action="/adm/expert">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <span style="display: -moz-inline-block; display: inline-block; width: 200px">
                    <input value="@if(isset($search)){{$search}}@endif" type="text" id="search" name="search" class="form-control mr-sm-2" style="width: 200px" placeholder="Search">
                </span>
                <span><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></span>
                </form>
            </div>
        </div>

        <br><button type="button" class="btn btn-primary" onclick="window.location.href='/adm/expert/add-expert'">新增专家</button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>姓名</th>
                <th>职称</th>
                <th>科室</th>
                <th>医院</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <form>
            @foreach($experts as $v)
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <tr>
                    <th scope="row">{{$v->id}}</th>
                    <td>{{$v->name}}</td>
                    <td>{{$v->title}}</td>
                    <td>{{$v->department}}</td>
                    <td>{{$v->hospital}}</td>
                    <td>
                        <a href="/adm/expert/edit-expert/{{$v->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> &nbsp;&nbsp;&nbsp;
                        <a onclick="delexpert({{$v->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </td>
                </tr>
            @endforeach
            </form>
            </tbody>
        </table>

        @if(isset($search))
            {{$experts->appends(array('search' => $search))->links()}}
        @else
            {{$experts->links()}}
        @endif

        <script>
            function delexpert(id){
                var mymessage = confirm("确定删除该专家么？");
                if (mymessage) {
                    data = {
                        'id': id,
                        '_token': $("#_token").val()
                    };
                    $.post('/adm/expert/del-expert', data, function (data) {
                        if (data.success) {
                            location.href = "/adm/expert";
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