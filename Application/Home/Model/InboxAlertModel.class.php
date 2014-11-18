<?php
namespace Home\Model;
use Think\Model;

class InboxAlertModel extends Model{
	public function new_send($uid){
		$find_uid = $this->where('uid=%d',$uid)->getField('uid');
		$data = array(
				'uid'		=> $uid,
				'numb'		=> array('exp','numb+1')
				);
		//判断$find_uid是否存在 存在修改 不存在添加
		if($find_uid){
			$this->where('uid=%d',$uid)->create($data);
			if($this->save()) return true;
			else return false;
		}else{
			$this->create($data);
			if($this->add()) return true;
			else return false;
		}

	}

	public function clean(){
		$uid = session('user_auth_sign');
		$find_uid = $this->where('uid=%d',$uid)->getField('uid');
		$data = array(
				'uid'		=> $uid,
				'numb'		=> 0
				);
		if($find_uid){
			$this->where('uid=%d',$uid)->create($data);
			if($this->save()) return true;
			else return false;
		}else{
			return true;
		}

	}
}

?>