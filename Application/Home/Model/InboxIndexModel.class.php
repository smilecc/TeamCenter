<?php
namespace Home\Model;
use Think\Model;

class InboxIndexModel extends Model{
	public function new_send($uid1,$uid2,$inbox_id,$from){
		$index_id = $this->where('uid1=%d AND uid2=%d',$uid1,$uid2)->getField('id');
		$data = array(
				'uid1'		=> $uid1,
				'uid2'   	=> $uid2,
				'from'		=> $from,
				'inbox_id'  => $inbox_id,
				'numb'		=> array('exp','numb+1')
				);
		//判断index_id是否存在 存在修改 不存在添加
		if($index_id){
			$this->where('id=%d',$index_id)->create($data);
			if($this->save()) return true;
			else return false;
		}else{
			$this->create($data);
			if($this->add()) return true;
			else return false;
		}

	}
}

?>