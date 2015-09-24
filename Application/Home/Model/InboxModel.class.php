<?php
namespace Home\Model;
use Think\Model;

class InboxModel extends Model{
	public function send($toname,$content,$fromuser=null){
		if(!$toname or !$content) return false;
		if($fromuser==null) $uid1 = session('user_auth_sign');
		else $uid1 = $fromuser;
		$uid2 = M('User')->where("username='%s'",$toname)->getField('uid');
		$touid = $uid2;
		if(!$uid2) return false;
		
		/*
		注解：
		判断信息是由哪方发送
		gtuid是一个uid1是否大于uid2的全局函数，如果大于则颠倒两变量的值 返回 true，不大于则 无操作 返回 false
		由于在调用本方法的时候，uid1总是发件人，uid2总是收件人。
		如果通过gtuid()颠倒后，所以发件人变为uid2，所以赋值变量from为2
		*/
		if(gtuid($uid1,$uid2)) $from = 2;
		else $from = 1;
		$data = array(
				'uid1'		=> $uid1,
				'uid2'   	=> $uid2,
				'from'  	=> $from,
				'content'	=> $content
				);
		if($this->create($data)){
			$inbox_id = $this->add();
			if(!$inbox_id) return false;
			if(!D('InboxAlert')->new_send($touid)) return false;
			if(D('InboxIndex')->new_send($uid1,$uid2,$inbox_id,$from)) return true;
			else return false;
		}else{
			return false;
		}

	}
}

?>