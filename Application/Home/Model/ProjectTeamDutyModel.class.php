<?php
namespace Home\Model;
use Think\Model;

class ProjectTeamDutyModel extends Model{
	public function add_new($name,$content,$pid){
		if(!$content or !$name or !$pid) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'name'   	=> $name,
				'content'  	=> $content,
				'pid'		=> $pid,
				);
		if($this->create($data)){
			return $this->add();
		}else{
			return false;
		}

	}
}

?>