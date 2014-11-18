<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller {
	public function index(){
		$member = M('User')->order('admin desc')->select();

		$this->assign('member',$member);
		$this->display();
	}
}