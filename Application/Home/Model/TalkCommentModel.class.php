<?php
namespace Home\Model;
use Think\Model;

class TalkCommentModel extends Model{
	public function add_new($tid,$content){
		if(!$content or !$tid) return false;
		session('atpage',$tid);
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'tid'   	=> $tid,
				'content'  	=> ParseAtUser($content),
				);
		trace($data,'DEBUG','user',true);
		session('atpage',null);
		if($this->create($data)){
			$this->add();
			return true;
		}else{
			return false;
		}

	}
}

?>