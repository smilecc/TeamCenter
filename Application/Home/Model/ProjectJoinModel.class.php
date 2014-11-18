<?php
namespace Home\Model;
use Think\Model;

class ProjectJoinModel extends Model{
	public function join_new($pid,$content){
		$data = array(
				'pid'		=> $pid,
				'uid'		=> session('user_auth_sign'),
				'content'   => $content
				);
		if($this->create($data)){
			if($this->add()) return true;
			else return false;
		}else{
			return false;
		}

	}

	public function set_join($join_id,$allow){

		/*
		allow == 1 为同意
		allow == 2 为拒绝
		*/
		$data = array(
					'id' => $join_id,
					'allow' => $allow
			);
		$this_join = $this->where('id=%d',$join_id)->find();
		if($this->create($data,Model::MODEL_UPDATE) AND ($allow==2 ? 1 : D('ProjectMember')->add_member($this_join['pid'],$this_join['uid']))){
			if($this->save()) return true;
			else return false;
		}else{
			return false;
		}
	}
}

?>