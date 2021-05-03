@extends('layout.common')
@section('title', '用户管理')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12" id="content">
        <div class="app_content_div" id="app_content_div_301Index">
            <h3>管理员用户列表</h3>
        </div>

        <div>
            <div style="float:right;">
                <button type="button" class="btn btn-primary" onclick="window.location.href='/adm/user/add-user'">新增管理员</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>id</th>
                <th>用户名</th>
                <th>更改密码</th>
                <th>删除</th>
            </tr>
            </thead>
            <tbody>
            <form>
            @foreach($users as $v)
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
                <tr>
                    <th scope="row">{{$v->id}}</th>
                    <td>{{$v->username}}</td>
                    <td><a style="cursor:pointer;" href="/adm/user/edit-user/{{$v->id}}">更改密码</a></td>
                    <td><a onclick="deluser({{$v->id}})"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                </tr>
            @endforeach
            </form>
            </tbody>
        </table>

        {{$users->links()}}

        <script>
            function deluser(id){
                var mymessage = confirm("确定删除么？");
                if (mymessage) {
                    data = {
                        'id': id,
                        '_token': $("#_token").val()
                    };
                    $.post('/adm/user/del-user', data, function (data) {
                        if (data.success) {
                            location.href = "/adm/user";
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