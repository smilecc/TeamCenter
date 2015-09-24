<?php
// markdown解析器
include("Parsedown.php");

// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function is_login(){
	if(session('user_auth_sign')!=NULL) return true;
	else return false;
}

function isAdmin(){
	return M('User')->where('uid=%d',session('user_auth_sign'))->getField('admin');
}

function getTalkclassCount($id){
	if($id==0) return M('Talk')->count();
	return M('Talk')->where('class=%d',$id)->count();
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
	if($class_id==-1) return '无';
	if($class_id==0) return '全部节点';
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

// 解析Markdown文本
function ParseMd($text)
{
   return Parsedown::instance()
    ->setBreaksEnabled(true)
    ->setMarkupEscaped(true) # escapes markup (HTML)
    ->text($text);
}
// 解析Markdown文本 - 行模式
function ParseMdLine($text)
{
   return Parsedown::instance()
    ->setBreaksEnabled(true)
    ->setMarkupEscaped(true) # escapes markup (HTML)
    ->line($text);
}

function GetUserPage($username){
	$uid = M('User')->where("username='%s'",$username)->getField('uid');
	if($uid == null) return false;
	else return U('/Home/User/People/'.$uid);
}

// 解析内容中@用户的事件
function ParseAtUser($value)
{
    return $temp_value = preg_replace_callback(
            "/@([\S]+)\s{1}/",
            function ($matches) {
            	$page = GetUserPage($matches[1]);
            	if($page){
            		$content = "[".$matches[0]."](".GetUserPage($matches[1]).")";
            		$tid = session('atpage');
            		$tinfo = M('Talk')->where('id=%d',$tid)->find();
            		$lastComment = M('TalkComment')->where('tid=%d',$tid)->order('id desc')->find();
            		$atcontent = $content." 在 《[".$tinfo['title']."](".U('Home/Talkpage/'.$tid).'#reply'.$lastComment['id'].")》 中提到/回复了你。";
            		D('Inbox')->send($matches[1],$atcontent,2);
                	return $content;
            	}else{
            		return $matches[0];
            	}

            },
            $value
        );
}

?>