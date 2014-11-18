<?php
namespace User\Model;
use Think\Model;

class UserModel extends Model{

	/* 用户模型自动验证 */
	protected $_validate = array(
		/* 验证用户名 */
		array('username', '1,8', -1, self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
		//array('username', 'checkDenyMember', -2, self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
		array('username', '', -3, self::EXISTS_VALIDATE, 'unique'), //用户名被占用

		/* 验证密码 */
		array('password', '6,16', -4, self::EXISTS_VALIDATE, 'length'), //密码长度不合法

		/* 验证邮箱 */
		array('email', 'email', -5, self::EXISTS_VALIDATE), //邮箱格式不正确
		array('email', '1,32', -6, self::EXISTS_VALIDATE, 'length'), //邮箱长度不合法
		array('email', '', -8, self::EXISTS_VALIDATE, 'unique'), //邮箱被占用
	);

	/* 用户模型自动完成 */
	protected $_auto = array(
		array('password', 'md5', self::MODEL_BOTH, 'function'),
	);

	/*
	注册用户
	$username 用户名
	$password 密码
	$email    邮箱
	return    注册成功返回用户信息，注册失败返回错误编号
	*/
	public function register($username,$password,$email){
		$data = array(
			'username' => $username,
			'password' => $password,
			'email'    => $email
		);
		
		//添加用户
		if($this->create($data)){
			$uid = $this->add();
			return $uid ? $uid : 0;
		} else {
			return $this->getError();
		}
	}

	//用户登录
	public function login($email,$password){
		$find = array('email' => $email );
		$user = $this->where($find)->find();
		if($user['password']==md5($password)){
			$info = array(
				'email'    => $user['email'],
				'username' => $user['username'],
				'uid'	   => $user['uid']
				);
			return $info;
		}
		else {
			return 0;
		}
	}

	//修改用户信息
	public function user_update($data){
		if($this->save($data) !== false) return true;
		else return false;
	}
}

?>