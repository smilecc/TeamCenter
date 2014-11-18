<?php
namespace Home\Model;
use Think\Model;

class ResModel extends Model{
	public function add_new($name,$content,$class,$url){
		if(!$url or !$name or !$class) return false;
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'name'   	=> $name,
				'content'  	=> $content,
				'class'		=> $class,
				'url'		=> $url
				);
		if($this->create($data)){
			$this->add();
			return true;
		}else{
			return false;
		}

	}
}

?>