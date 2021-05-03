@extends('layout.common')
@section('title', '新增管理员')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12" id="content">

        <div class="app_content_div" id="app_content_div_301Index">
            <h3>新增管理员</h3>
        </div>
        <form class="form-horizontal">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label"><span style="color:red;">*</span>用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="width:300px;" id="username" name="username">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label"><span style="color:red;">*</span>密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" style="width:300px;" id="password" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label"><span style="color:red;">*</span>确认密码</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" style="width:300px;" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="button" class="btn btn-default" onclick="addUser()" value="确定">
                </div>
            </div>
        </form>

        <script type="text/javascript" language="javascript">

            function addUser() {
                data = {
                    'username': $("#username").val().trim(),
                    'password': $("#password").val(),
                    'password_confirmation': $("#password_confirmation").val(),
                    '_token': $("#_token").val()
                };
                $.post('/adm/user/add-user', data, function (data) {
                    if (data.success) {
                        alert(data.msg);
                        location.href = "/adm/user";
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            }

        </script>

    </div>
</div>
@endsection