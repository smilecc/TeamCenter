<?php
namespace Home\Model;
use Think\Model;

class ProjectTeamDutyDetailsModel extends Model{
	public function add_new($name,$content,$duty_id,$tousername,$pid,$deadline=0){
		if(!$content or !$name or !$duty_id or !$tousername) return false;
		$touid = M('User')->where("username='%s'",$tousername)->getField('uid');
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'name'   	=> $name,
				'content'  	=> $content,
				'duty_id'	=> $duty_id,
				'touid'		=> $touid,
				'deadline'	=> $deadline,
				'pid'		=> $pid
				);
		if($this->create($data)){
			return $this->add();
		}else{
			return false;
		}

	}

	public function set_active($details_id,$active=0){
		if(!$details_id) return false;
		if(session('user_auth_sign') != $this->where('id=%d',$details_id)->getField('touid')) return false;
		$data = array(
				'id'		=> $details_id,
				'active'   	=> $active
				);
		if($this->create($data)){
			return $this->save();
		}else{
			return false;
		}

	}
}

?>