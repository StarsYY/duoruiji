<?php


class UserController extends BaseController
{
    /**
     * 控制器过滤器
     */
    public function __construct() {
        $this->beforeFilter('auth', array('except'=>array('Login', 'DoLogin')));
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    /**
     * 后台首页
     */
    public function adminIndex(){
        return View::make('adminindex');
    }

    /**
     * 用户列表页
     */
    public function getIndex(){
        $users = User::paginate(10);
        return View::make('user.list')->with('users', $users);
    }

    /**
     * 添加新用户
     */
    public function getAddUser(){
        return View::make('user.adduser');
    }

    public function postAddUser(){
        $datas = Input::all();
        $rules = array(
            'username'=>'required|unique:users|alpha_num',
            'password'=>'required|min:6|confirmed'
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg1 = $validator->messages()->first('username');
            $msg3 = $validator->messages()->first('password');
            $msg = $msg1."\n".$msg3;
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $user = new User();
        $user->username=$datas['username'];
        $user->password=Hash::make($datas['password']);
        $user->save();

        return json_encode(array('success'=>true, 'msg'=>'添加成功'));
    }

    /**
     * 修改密码
     */
    public function getEditUser($id){
        $user = User::find($id);
        return View::make('user.edituser')->with('user', $user);
    }

    public function postEditUser(){
        $datas = Input::all();
        $rules = array(
            'password'=>'required|min:6|confirmed',
        );
        $validator = Validator::make($datas,$rules);
        if ($validator->fails()){
            $msg = $validator->messages()->first('password');
            return json_encode(array('success'=>false, 'msg'=>$msg));
        }

        $id = $datas['id'];
        $password = $datas['password'];
        $user = User::find($id);
        $user->password=Hash::make($password);
        $user->save();

        return json_encode(array('success'=>true, 'msg'=>'修改成功'));
    }

    /**
     * 删除管理员
     */
    public function postDelUser(){
        $datas = Input::all();
        User::destroy($datas['id']);

        return json_encode(array('success'=>true, 'msg'=>"删除成功"));
    }

    /**
     * 登录后台
     */
    public function Login(){
        return View::make('user.login');
    }

    public function DoLogin(){
        $username=Input::get('username');
        $password=Input::get('password');
        if (Auth::attempt(array('username'=>$username, 'password'=>$password))){
            return Redirect::to('/adm');
        } else{
            return Redirect::to('/login');
        }
    }

    /**
     * 用户注销
     */
    public function Logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
}