<?php


class ExpertController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except'=>array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    /**
     * 专家列表页
     */
    public function getIndex(){
        Input::has('search') ? $search = Input::get('search') : $search = '';
        $experts = Expert::Where('name','like','%'.$search.'%')->paginate(10);
        return View::make('expert.list')->with('experts', $experts)->with('search', $search);
    }

    /**
     * 新增专家
     */
    public function getAddExpert(){
        return View::make('expert.addexpert');
    }

    public function postAddExpert(){
        $date = Input::all();
        $rules = array(
            'name'=>'required',
            'photo'=>'required',
            'department'=>'required',
            'title'=>'required',
            'position'=>'required',
            'hospital'=>'required',
            'introduction'=>'required',
            'edu'=>'required'
        );
        $validator = Validator::make($date,$rules);
        if ($validator->fails()){
            $errors = "请按要求填写信息";
            return View::make('expert.addexpert')->withErrors($errors);
        }

        $expert = new Expert();
        $expert->name=Input::get('name');
        $expert->portrait=Input::get('photo');
        $expert->department=Input::get('department');
        $expert->title=Input::get('title');
        $expert->position=Input::get('position');
        $expert->hospital=Input::get('hospital');
        $expert->introduction=Input::get('introduction');
        $expert->edu=Input::get('edu');
        $expert->save();

        return Redirect::to("/adm/expert");
    }

    /**
     * 编辑专家
     */
    public function getEditExpert($id){
        $expert = Expert::find($id);
        return View::make('expert.editexpert')->with('expert', $expert);
    }

    public function postEditExpert(){
        $datas = Input::all();
        $rules = array(
            'name'=>'required',
            'photo'=>'required',
            'department'=>'required',
            'title'=>'required',
            'position'=>'required',
            'hospital'=>'required',
            'introduction'=>'required',
            'edu'=>'required'
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $errors = "请按要求填写信息";
            return Redirect::to("/adm/expert/edit-expert/".$datas['id'])->withErrors($errors);
        }

        $expert = Expert::find($datas['id']);
        $expert->name=$datas['name'];
        $expert->portrait=$datas['photo'];
        $expert->department=$datas['department'];
        $expert->title=$datas['title'];
        $expert->position=$datas['position'];
        $expert->hospital=$datas['hospital'];
        $expert->introduction=$datas['introduction'];
        $expert->edu=$datas['edu'];
        $expert->update();

        return Redirect::to("/adm/expert");
    }

    /**
     * 删除专家
     */
    public function postDelExpert(){
        $datas = Input::all();
        Expert::destroy($datas['id']);

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

            $rPath = "public/upload/expert_thumb/$ext/" . date('Ymd', time());
            mkdirs($rPath); // 创建文件夹

            $tPath = "/upload/expert_thumb/$ext/" . date('Ymd', time());
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