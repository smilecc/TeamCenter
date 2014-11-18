<?php
namespace Home\Model;
use Think\Model;

class ProjectMemberModel extends Model{
	public function add_member($pid,$uid,$admin=0){
		$data = array(
				'pid'		=> $pid,
				'uid'		=> $uid,
				'admin'     => $admin,
				);
		if($this->create($data)){
			if($this->add()) return true;
			else return false;
		}else{
			return false;
		}
	}

	public function set_admin($pid,$uid){
		if(!$pid or !$uid) return false;
		//检查权限
		$is_creater = M('Project')->where('id=%d AND uid=%d',$pid,session('user_auth_sign'))->find();
		$member = $this->where('pid=%d AND uid=%d',$pid,$uid)->find();
		if(!count($is_creater) or !count($member)) return false;

		$data = array(
				'id'		=> $member['id'],
				'admin'     => !$member['admin'],
				);
		if($this->create($data,Model::MODEL_UPDATE)){
			if($this->save()) return true;
			else return false;
		}else{
			return false;
		}
	}

	public function delete_member($pid,$uid){
		if(!$pid or !$uid) return false;
		//检查权限

		//检查操作用户是否为创建者
		$is_creater = M('Project')->where('id=%d AND uid=%d',$pid,session('user_auth_sign'))->find();
		//检查操作用户是否为管理员
		$is_admin = $this->where('pid=%d AND uid=%d AND admin=1',$pid,session('user_auth_sign'))->find();
		//检查被操作用户是否为管理员
		$member = $this->where('pid=%d AND uid=%d',$pid,$uid)->find();
		if(!count($is_creater) AND !count($is_admin)) return false;
		if(count($is_admin) AND $member['admin']) return false;


		if($this->where('pid=%d AND uid=%d',$pid,$uid)->delete()){
			return true;
		}else{
			return false;
		}
	}

}

?>