@extends('layout.common')
@section('title', '重置密码')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="col-md-12" id="content">

            <div class="app_content_div" id="app_content_div_301Index">
                <h3>重置密码</h3>
            </div>
            <form class="form-horizontal">
                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />

                <input type="text" name="id" id="id" value="{{$user->id}}" hidden>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label"><span style="color:red;">*</span>输入新密码</label>
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
                        <input type="button" class="btn btn-default" onclick="editUser()" value="确定">
                    </div>
                </div>

                <p id="success" hidden>密码重置成功</p>
            </form>

            <script type="text/javascript" language="javascript">

                function editUser() {
                    data = {
                        'id': $("#id").val(),
                        'password': $("#password").val(),
                        'password_confirmation': $("#password_confirmation").val(),
                        '_token': $("#_token").val()
                    };
                    $.post('/adm/user/edit-user', data, function (data) {
                        if (data.success) {
                            $("#password").val("");
                            $("#password_confirmation").val("");
                            $("#success").show();
                        } else {
                            alert(data.msg);
                        }
                    }, 'json');
                }

            </script>

        </div>
    </div>
@endsection