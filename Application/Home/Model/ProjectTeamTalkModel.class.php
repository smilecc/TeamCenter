<?php
namespace Home\Model;
use Think\Model;

class ProjectTeamTalkModel extends Model{
	public function add_new($title,$content,$class,$project_id){
		if(!$content or !$title or !$class or !$project_id) return false;
		$tid = D('Talk')->add_new($title,$content,$class,$project_id);
		if(!$tid) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'tid'   	=> $tid,
				'pid'		=> $project_id,
				);
		if($this->create($data)){
			return $this->add();
		}else{
			return false;
		}

	}
}

?>