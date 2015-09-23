<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
	public function index(){
		$TalkClass = M('TalkClass')->where('status=0')->select();
		$this->assign('talkclass',$TalkClass);
		$this->display();
	}

	public function register_node($nid,$allow){
		if(!isAdmin()){
			return false;
		}

		if($allow){
			M('TalkClass')->where('id=%d',$nid)->setField('status',1);
		}else{
			M('TalkClass')->where('id=%d',$nid)->delete();
		}
		echo 1;
	}
}