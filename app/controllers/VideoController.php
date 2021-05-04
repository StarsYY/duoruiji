<?php


class VideoController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except'=>array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    /**
     * 直播/录播列表页
     */
    public function getIndex(){
        Input::has('search') ? $search = Input::get('search') : $search = '';
        $videos = Video::Where('title','like','%'.$search.'%')->orderBy('id', 'desc')->paginate(10);
        foreach ($videos as $v){
            $video = Video::find($v->id);
            $experts = $video->experts;
            foreach ($experts as $e){
                $v['name'] = $e->name;
                $v['department'] = $e->department;
                break;
            }
        }
        return View::make('video.list')->with('videos', $videos)->with('search', $search);
    }

    /**
     * 新增视频
     */
    public function getAddVideo(){
        $experts = Expert::all();
        return View::make('video.addvideo')->with('experts', $experts);
    }

    public function postAddVideo(){
        $datas = Input::all();
        $rules = array(
            'title'=>'required',
            'url'=>'required',
            'course'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'photo'=>'required'
        );
        $validator = Validator::make($datas,$rules);
        if (empty ($datas['doc_id']) == true || in_array('0', $datas['doc_id']) || $validator->fails()){
            $errors = "请按要求填写信息";
            return Redirect::to("/adm/video/add-video")->withErrors($errors);
        } else {
            $video = new Video();
            $video->title = $datas['title'];
            $video->url = "/videos/video.mp4";
            $video->type = $datas['type'];
            $video->course = $datas['course'];
            $video->start_time = $datas['start_time'];
            $video->end_time = $datas['end_time'];
            $video->cover = $datas['photo'];
            $video->save();

            $addexpert = Video::find($video->id);
            $addexpert->experts()->sync($datas['doc_id']);

            return Redirect::to("/adm/video");
        }
    }

    /**
     * 编辑视频
     */
    public function getEditVideo($id){
        $video = Video::find($id);
        $experts = Expert::all();
        $addexperts = $video->experts;
        return View::make('video.editvideo')->with('video', $video)->with('experts', $experts)->with('addexperts', $addexperts);
    }

    public function postEditVideo(){
        $datas = Input::all();
        $rules = array(
            'title'=>'required',
            'url'=>'required',
            'course'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'photo'=>'required'
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $errors = "请按要求填写信息";
            return Redirect::to("/adm/video/edit-video/".$datas['id'])->withErrors($errors);
        }

        $video = Video::find($datas['id']);
        $video->title=$datas['title'];
        $video->url="/videos/video.mp4";
        $video->type=$datas['type'];
        $video->course=$datas['course'];
        $video->start_time=$datas['start_time'];
        $video->end_time=$datas['end_time'];
        $video->cover=$datas['photo'];
        $video->update();

        $addexpert = Video::find($video->id);
        $addexpert->experts()->sync($datas['doc_id']);

        return Redirect::to("/adm/expert");
    }

    /**
     * 删除视频
     */
    public function postDelVideo(){
        $datas = Input::all();
        Video::destroy($datas['id']);

        return json_encode(array('success'=>true, 'msg'=>"删除成功"));
    }

    /**
     * 上传图片
     */
    public function postUpload(){
        if ($_FILES['upload_file']['error'] > 0) {
            return json_encode(array('success' => false, 'msg' => '上传失败'));
        } else {
            $fileext = $_FILES["upload_file"]["type"];
            $allow_types = array("image/jpeg", "image/jpg", "image/png", "image/gif");
            if (!in_array($fileext, $allow_types)) {
                return json_encode(array('success' => false, 'msg' => '该文件不是图片'));
            }

            $ext = substr($_FILES["upload_file"]["name"], strrpos($_FILES["upload_file"]["name"], ".") + 1);
            $rand_name = date('YmdHis', time()) . rand(1000, 9999);

            $rPath = public_path() . "/upload/video_thumb/$ext/" . date('Ymd', time());
            mkdirs($rPath); // 创建文件夹

            $tPath = "/upload/video_thumb/$ext/" . date('Ymd', time());
            $aRealPath = public_path() . $tPath . "/" . $rand_name;

            move_uploaded_file($_FILES['upload_file']['tmp_name'], $aRealPath . "." . $ext);

            $rust = getimagesize($aRealPath . "." . $ext);
            $width = $rust[0];//原图的宽
            $height = $rust[1];//原图的高
            $target = imagecreatetruecolor($width / 10, $height / 10);
            if ($ext == "jpg" || $ext == "jpeg") {
                $source = imagecreatefromjpeg($aRealPath . "." . $ext);
            } elseif ($ext == "png"){
                $source = imagecreatefrompng($aRealPath . "." . $ext);
            } elseif ($ext == "gif"){
                $source = imagecreatefromgif($aRealPath . "." . $ext);
            }
            imagecopyresampled($target, $source, 0, 0, 0, 0, $width / 10, $height / 10, $width, $height);
            if (($ext == "jpg") || ($ext == "jpeg")) {
                imagejpeg($target, $aRealPath . "." . $ext, 100);
            } elseif ($ext == "png"){
                imagepng($target, $aRealPath . "." . $ext, 9);
            } elseif ($ext == "gif"){
                imagegif($target, $aRealPath . "." . $ext);
            }

            $iamgeUrl = $tPath . "/" . $rand_name . "." . $ext;

            echo json_encode(array('success' => true, 'photo' => $iamgeUrl));
            die;
        }
    }
}