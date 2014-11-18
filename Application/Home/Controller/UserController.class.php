<?php
namespace Home\Controller;
use User\Api\UserApi;
class UserController extends IndexController {
	public function index(){

	}
	//用户设置页面
	public function settings(){
if(!is_login()) $this->error('请登录后再进行操作!','/Home/User/login');
$upfolder = "uploads/"; //文件上传目录
if(!empty($_FILES)){
	
	$tempfile = $_FILES['filedata']['tmp_name']; //文件临时目录
	$path_info = pathinfo($upfolder.$_FILES['filedata']['name']);
	$filename = session('user_auth_sign').'.'.$path_info['extension'];
	$imagepath = $upfolder.$filename;
	$array = array();
	if(move_uploaded_file($tempfile,$upfolder.$filename)){  //将文件从临时目录移动到保存目录
		$array = array(
			'status' => 1,
			'src' => 'http://'.$_SERVER['HTTP_HOST'].'/'.$upfolder.$filename,		
			);
		echo json_encode($array);
	}else{
		echo 0;
	}
	
	exit;	
}

/*************按照坐标裁切图片********************/
$action = $_GET['action'];  
if($action=='jcrop'){
	$crop = $_POST['crop'];
	if($crop){
		$targ_w = $targ_h = 100;
		$src = $crop['path']; //图片全地址
		$pathinfo = pathinfo($src);
		$filename = 'uploads/small'.$targ_w.'_'.$pathinfo['basename'];
		
		$img_r = imagecreatefromjpeg($src); //从url新建一图像
		$dst_r = imageCreateTrueColor($targ_w,$targ_h); //创建一个真色彩的图片源
		imagecopyresampled($dst_r,$img_r,0,0,$crop['x'],$crop['y'],$targ_w,$targ_h,$crop['w'],$crop['h']);
		imagejpeg($dst_r,$filename,90);
		return 1;
	}	
}

		if(IS_POST){
			$user = new UserApi;
			//执行用户信息修改
			/*
			type = 1 修改资料
			type = 2 修改密码
			*/
			if(I('post.type')==1){
				$data = array(
					'uid' 		=> session('user_auth_sign'),
					'sex' 		=> (I('post.sex')=='man'?1:0),
					'birthday'  => I('post.birthday'),
					'content'  => I('post.content'),
					);
				if($user->user_update($data)) $this->success('修改成功！',U('/Home/User/settings'));
				else $this->error('修改失败！',U('/Home/User/settings'));
			} elseif (I('post.type')==2) {
				$user_info = M('user')->where('uid=%d',session('user_auth_sign'))->find();
				if($user_info['password']!=md5(I('post.oldpw'))) {$this->error('原密码错误！');return;}
				$data = array(
					'uid' 		=> session('user_auth_sign'),
					'password'  => md5(I('newpw'))
					);
				if($user->user_update($data)) $this->success('修改成功！',U('/Home/User/settings'));
				else $this->error('修改失败！',U('/Home/User/settings'));

			}
		} else {
			//获取用户信息
			$user = M('user'); //实例化user数据表
			$user_info = $user->where('uid=%d',session('user_auth_sign'))->find();
			$this->assign('user_info',$user_info);
			$this->display();
		}
	}

	//用户登录
    public function login($email='',$password='',$verify=''){
    	if(IS_POST){
    		/* 检测验证码 */
			if(!check_verify($verify)){
				$this->error('验证码输入错误！',U('/Home/User/login'));
			}
    		$user = new UserApi;
    		//$res_info 返回的用户信息
    		$res_info = $user->login($email,$password);
    		if($res_info){
    			$user->autologin($res_info['email'],$res_info['username'],$res_info['uid']);
    			$this->success('登录成功！', U('/Home/'),3);
    		}
    		else $this->error('登录失败，密码错误或用户不存在！',U('/Home/User/login'));
    	}                        
		else {
			if(is_login()) {$this->success('已登录，请退出后再进行相关操作', U('/Home/'),3);return;}
			//echo session('user_auth_sign');
			$this->display();}
    }

    //用户注册
    public function register($username='',$password='',$pwag='',$email='',$verify=''){
    	if(IS_POST){

			/* 检测验证码 */
			if(!check_verify($verify)){
				$this->error('验证码输入错误！',U('register'));
			}

			/* 检测密码 */
			if($password != $pwag){
				$this->error('密码和重复密码不一致！');
			}			

			$user = new UserApi;
			$uid = $user->register($username,$password,$email);
			if(0 < $uid){ //注册成功
				//TODO: 发送验证邮件
				$this->success('注册成功！',U('login'));
			} else { //注册失败，显示错误信息
				$this->error($this->showRegError($uid));
			}
    	} 
    	else $this->display();
    }

    //用户登出
    public function logout(){
    	$user = new UserApi;
    	$user->logout();
    	if(session('user_auth_sign')==NULL) $this->success('登出成功！',U('login'));
    	else $this->error('登出失败！');
    }
    //用户个人页面
    public function people(){
    	//echo $_GET['uid'];session('user_auth_sign')
    	$user_info = M('user')->where('uid=%d',$_GET['uid'])->find();
    	$ta_res = M('Res')->where('uid=%d',$_GET['uid'])->order('id desc')->select();
    	$ta_talk = M('Talk')->where('uid=%d',$_GET['uid'])->order('id desc')->select();
    	$ta_project = M('Project')->where('uid=%d',$_GET['uid'])->order('id desc')->select();
    	$ta_project_member = M('ProjectMember')->where('uid=%d',$_GET['uid'])->order('admin desc')->select();

    	$this->assign('ta_res',$ta_res);
    	$this->assign('ta_talk',$ta_talk);
    	$this->assign('ta_project',$ta_project);
    	$this->assign('ta_project_member',$ta_project_member);
    	$this->assign('user_info',$user_info);
    	//$this->assign('fans',$fans);
    	$this->display();
    }

    //验证码
    public function verify(){
    	//定义验证码大小
    	$config = array(
    		'length' => 3,
    		'imageW' => 160, 
    		'imageH' => 45
    		);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}
	//注册错误代码解析
	private function showRegError($code = 0){
		switch ($code) {
			case -1:  $error = '用户名长度必须在16个字符以内！'; break;
			case -2:  $error = '用户名被禁止注册！'; break;
			case -3:  $error = '用户名被占用！'; break;
			case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
			case -5:  $error = '邮箱格式不正确！'; break;
			case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
			case -7:  $error = '邮箱被禁止注册！'; break;
			case -8:  $error = '邮箱被占用！'; break;
			case -9:  $error = '手机格式不正确！'; break;
			case -10: $error = '手机被禁止注册！'; break;
			case -11: $error = '手机号被占用！'; break;
			default:  $error = '未知错误';
		}
		return $error;
	}
}
