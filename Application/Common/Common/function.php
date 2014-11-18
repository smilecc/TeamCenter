<?php

// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function is_login(){
	if(session('user_auth_sign')!=NULL) return true;
	else return false;
}
/*
返回头像地址
1=小头像
2=大头像
*/
function return_display($uid){
	$file_name = 'small100_'.$uid.'.jpg';
	if(is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file_name)){
		return '/uploads/'.$file_name;
	} else {
		return '/Public/img/display.png';
	}
}

//获取用户名
function getUsername($uid){
	$user = M('User');
	return $user->where('uid=%d',$uid)->getField('username');
}

//获取项目名
function getProjectname($pid){
	$user = M('Project');
	return $user->where('id=%d',$pid)->getField('name');
}

//获取资源类名
function getResclassname($class_id){
	$res_class = M('ResClass');
	return $res_class->where('id=%d',$class_id)->getField('name');
}

//获取讨论标题
function getTalktitle($talk_id){
	return M('Talk')->where('id=%d',$talk_id)->getField('title');
}


//获取讨论类名
function getTalkclassname($class_id){
	$res_class = M('TalkClass');
	return $res_class->where('id=%d',$class_id)->getField('name');
}

//gtuid 比较两UID大小，uid1比uid2大时 颠倒两变量值，uid1比uid2小时 则不变
function gtuid(&$uid1,&$uid2){
	if($uid1>$uid2){
		$i = $uid2;
		$uid2 = $uid1;
		$uid1 = $i;
		return true;
	}else return false;
}

//用inbox_id获取该私信内容
function getInboxcontent($inbox_id){
	return M('Inbox')->where('id=%d',$inbox_id)->getField('content');
}

function getInboxalert(){
	return M('InboxAlert')->where('uid=%d',cookie('user_id'))->getField('numb');
}

function getDutyname($duty_id){
	return M('ProjectTeamDuty')->where('id=%d',$duty_id)->getField('name');
}
?>