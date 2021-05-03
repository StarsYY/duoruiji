@extends('layout.common')
@section('title', '编辑专家')
@section('content')
    @if(count($errors)>0)
        <script>
            alert({{$errors}});
        </script>
    @endif
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="col-md-12" id="content">
        <div class="app_content_div" id="app_content_div_301Index">
            <h3>编辑专家</h3>
        </div>
        <form action="/adm/expert/edit-expert" method="post" class="form-horizontal">
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <input type="hidden" id="id" name="id" value="{{$expert->id}}">

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label"><span style="color:red;">*</span>姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{$expert->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="upload_file" class="col-sm-2 control-label"><span style="color:red;">*</span>缩略图</label>
                <div class="col-sm-10">
                    <input type="file" id="upload_file" name="upload_file" onchange="saveThumbToExpert()"/>
                    <input type="hidden" class="form-control" id="photo" name="photo" value="{{$expert->portrait}}" >
                    <img style="width: 160px; height: 200px;" id="thumb" src="{{$expert->portrait}}" />
                </div>
            </div>
            <div class="form-group">
                <label for="department" class="col-sm-2 control-label"><span style="color:red;">*</span>科室</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="department" name="department" value="{{$expert->department}}">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label"><span style="color:red;">*</span>职称</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="{{$expert->title}}">
                </div>
            </div>
            <div class="form-group">
                <label for="position" class="col-sm-2 control-label"><span style="color:red;">*</span>职务</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="position" name="position" value="{{$expert->position}}">
                </div>
            </div>
            <div class="form-group">
                <label for="hospital" class="col-sm-2 control-label"><span style="color:red;">*</span>医院</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hospital" name="hospital" value="{{$expert->hospital}}">
                </div>
            </div>
            <div class="form-group">
                <label for="introduction" class="col-sm-2 control-label"><span style="color:red;">*</span>简介</label>
                <div class="col-sm-10">
                    <script type="text/plain" id="introduction" name="introduction">{{$expert->introduction}}</script>
                    <script type="text/javascript">
                        var editor = UE.getEditor('introduction')
                    </script>
                </div>
            </div>
            <div class="form-group">
                <label for="edu" class="col-sm-2 control-label"><span style="color:red;">*</span>接受教育</label>
                <div class="col-sm-10">
                    <script type="text/plain" id="edu" name="edu">{{$expert->edu}}</script>
                    <script type="text/javascript">
                        var editor = UE.getEditor('edu')
                    </script>
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