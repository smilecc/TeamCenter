<?php
namespace Home\Model;
use Think\Model;

class InformModel extends Model{
	public function add_new($content,$class_id=1,$project_id=0){
		if($class_id==1){
			$is_admin = M('User')->where('uid=%d',session('user_auth_sign'))->getField('admin');
			if(!$is_admin) return false;
		}
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'content'   => $content,
				'class_id'  => $class_id,
				'project_id'=> $project_id
				);
		if(!$content) return false;
		if($this->create($data)){
			$this->add();
			return true;
		}else{
			return false;
		}

	}
}

?>