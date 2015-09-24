<?php
namespace Home\Model;
use Think\Model;

class TalkModel extends Model{
	public function add_new($title,$content,$class,$project_id=0){
		if(!$content or !$title or !$class) return false;
		
		$data = array(
				'uid'		=> session('user_auth_sign'),
				'title'   	=> $title,
				'content'  	=> '',
				'class'		=> $class,
				'project_id'=> $project_id,
				);
		session('atpage',null);
		if($this->create($data)){
			$tid = $this->add();
			session('atpage',$tid);
			$data = array(
					'id'		=> $tid,
					'content'  	=> ParseAtUser($content),
					);
			$this->save($data);
			return $tid;
		}else{
			return false;
		}

	}
}

?>