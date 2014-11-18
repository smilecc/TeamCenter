<?php
namespace Home\Model;
use Think\Model;

class TalkCommentModel extends Model{
	public function add_new($tid,$content){
		if(!$content or !$tid) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'tid'   	=> $tid,
				'content'  	=> $content,
				);
		trace($data,'DEBUG','user',true);
		if($this->create($data)){
			$this->add();
			return true;
		}else{
			return false;
		}

	}
}

?>