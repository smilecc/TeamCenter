<?php
namespace Home\Model;
use Think\Model;

class ProjectModel extends Model{
	public function add_new($content,$name,$allow_join=1,$lang){
		if(!$name) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'content'   => $content,
				'name'  	=> $name,
				'allow_join'=> $allow_join,
				'lang'		=> $lang
				);
		if($this->create($data)){
			if($this->add()) return true;
			else return false;
		}else{
			return false;
		}

	}

	public function add_update($pid,$content,$allow_join,$lang){
		//检查权限
		$is_creater = $this->where('id=%d AND uid=%d',$pid,session('user_auth_sign'))->find();
		$is_admin = M('ProjectMember')->where('pid=%d AND uid=%d AND admin=1',$pid,session('user_auth_sign'))->find();
		if(!count($is_creater) AND !count($is_admin)) return false;

		$data = array(
				'id'		=> $pid,
				'content'   => $content,
				'allow_join'=> $allow_join,
				'lang'		=> $lang
				);
		if($this->create($data,Model::MODEL_UPDATE)){
			if($this->save()) return true;
			else return false;
		}else{
			return false;
		}
	}

}

?>