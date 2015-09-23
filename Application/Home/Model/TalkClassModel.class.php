<?php
namespace Home\Model;
use Think\Model;

class TalkClassModel extends Model{
	public function add_new($name,$father){
		if(!$name) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'name'   	=> $name,
				'father'  	=> $father,
				'status'	=> 0
				);
		if($this->create($data)){
			return $this->add();
		}else{
			return false;
		}

	}
}

?>