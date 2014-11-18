<?php
namespace User\Api;
use User\Model\UserModel;

class UserApi{
    /*
    初始化，实例化操作模型
    */
    protected $model;
    public function __construct(){
        $this->model = new UserModel();
    }
    //注册用户
    public function register($username,$password,$email){
    	return $this->model->register($username,$password,$email);
    }

    //用户登录
    public function login($email,$password){
        return $this->model->login($email,$password);
    }
    //登录标示
    public function autologin($email,$username,$uid){
        session('user_auth_sign',$uid);
        cookie('user_email',$email);
        cookie('user_name',$username);
        cookie('user_id',$uid);
    }
    //用户登出
    public function logout(){
        session('user_auth_sign',NULL);
        cookie('user_email',NULL);
        cookie('user_name',NULL);
        cookie('user_id',NULL);
    }
    //更新用户数据
    public function user_update($data){
        return $this->model->user_update($data);
    }
}
?>