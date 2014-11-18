<?php
namespace Home\Model;
use Think\Model;

class TalkModel extends Model{
	public function add_new($title,$content,$class,$project_id=0){
		if(!$content or !$title or !$class) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'title'   	=> $title,
				'content'  	=> $content,
				'class'		=> $class,
				'project_id'=> $project_id,
				);
		if($this->create($data)){
			return $this->add();
		}else{
			return false;
		}

	}
}

?>