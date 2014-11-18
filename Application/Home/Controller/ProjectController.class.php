<?php
namespace Home\Controller;
use Think\Controller;
class ProjectController extends IndexController {
	//首页
	public function index(){
		if(IS_POST){
				$project = D('Project');
				if($project->add_new(I('post.content'),I('post.name'),I('post.allow_join'),I('post.lang'))){
					$this->success("创建成功");
					}
					else{
					$this->error("创建失败");
					}
		}
		else {
			if(I('get.mode')=='creater'){
				$creater = M('Project')->where('uid=%d',session('user_auth_sign'))->select();
				$project_index_active = 'project_index_creater';
			}elseif(I('get.mode')=='admin'){
				$creater = M('Project')->where('uid=%d',session('user_auth_sign'))->select();
				$member = M('ProjectMember')->where('uid=%d AND admin=1',session('user_auth_sign'))->order('admin desc')->select();
				$project_index_active = 'project_index_admin';
			}elseif(I('get.mode')=='member'){
				$member = M('ProjectMember')->where('uid=%d AND admin=0',session('user_auth_sign'))->order('admin desc')->select();
				$project_index_active = 'project_index_member';
			}else{
				$creater = M('Project')->where('uid=%d',session('user_auth_sign'))->select();
				$member = M('ProjectMember')->where('uid=%d',session('user_auth_sign'))->order('admin desc')->select();
				$project_index_active = 'project_index_all';
			}
			
			$this->assign('project_index_active',$project_index_active);
			$this->assign('creater',$creater);
			$this->assign('member',$member);
			$this->display();
			}
	}

	//项目资料与设置页
	public function settings(){
		if(!I('get.pid')) {$this->error('Project_id参数丢失');return;}
		if(IS_POST){
			if(I('post.type')=="update"){ /*更新项目数据*/
				$project = D('Project');
				if($project->add_update(I('get.pid'),I('post.content'),I('post.allow_join'),I('post.lang'))){
					$this->success("修改成功");
					}else{
					$this->error("修改失败");
					}
			}elseif(I('post.type')=="exit"){ /*退出该项目*/
				if(M('ProjectMember')->where('uid=%d AND pid=%d',session('user_auth_sign'),I('get.pid'))->delete()){
					$this->success("退出成功");
				}else{
					$this->error("退出失败");
				}
			}elseif(I('post.type')=="join"){ /*申请加入项目*/
				$project_join = D('ProjectJoin');
				if($project_join->join_new(I('get.pid'),I('post.content'))){
					$this->success("申请递交成功，请耐心等待");
					}
					else{
					$this->error("申请递交失败");
				}
			}elseif(I('post.type')=="setadmin"){ /*创始人设置管理员 如果该用户为管理员 则取消其管理员*/
				$project_setadmin = D('ProjectMember');
				if($project_setadmin->set_admin(I('post.pid'),I('post.uid'))){
					echo("修改成功");
					}else{
					echo("修改失败");
				}
			}elseif(I('post.type')=="delete_member"){ /*删除用户*/
				$project_setadmin = D('ProjectMember');
				if($project_setadmin->delete_member(I('post.pid'),I('post.uid'))){
					echo("移除成功");
					}else{
					echo("移除失败");
				}
			}elseif(I('post.type')=="set_join"){ /*删除用户*/
				$project_setjoin = D('ProjectJoin');
				if($project_setjoin->set_join(I('post.join_id'),I('post.allow'))){
					echo("审批成功");
					}else{
					echo("审批失败");
				}
			}

		}else{
			$project_content = M('Project')->where('id=%d',I('get.pid'))->find();
			$project_content['lang_arr'] = explode(',',$project_content['lang']);

			$project_member = M('ProjectMember')->where('uid=%d AND pid=%d',session('user_auth_sign'),I('get.pid'))->find();
			//判断用户是否为管理员
			if($project_content['uid']==session('user_auth_sign')){
				$project_creater = 1;
				$project_admin = 1;
			}elseif($project_member['admin']==1){
				$project_creater = 0;
				$project_admin = 1;
			}else{
				$project_creater = 0;
				$project_admin = 0;
			}
			//判断用户是否为该项目会员
			if(count($project_member)) $project_is_member = true;
			else $project_is_member = false;
			
			//判断是否对非成员可见
			if(!$project_content['allow_join'] AND $project_content['uid']!=session('user_auth_sign') AND !$project_is_member) {
				$this->error('该项目不存在或对非成员不可见');
			}

			if($project_admin or $project_is_member){
				$project_member_list = M('ProjectMember')->where('pid=%d',I('get.pid'))->select();
				$project_join_list = M('ProjectJoin')->where('pid=%d AND allow=0',I('get.pid'))->order('id')->select();
				$this->assign('join_list',$project_join_list);
				$this->assign('member_list',$project_member_list);
			}

			$this->assign('admin',$project_admin);
			$this->assign('creater',$project_creater);
			$this->assign('project',$project_content);
			$this->assign('is_member',$project_is_member);
			$this->assign('empty_member','<div class="alert alert-info" role="alert"><P><b>本项目暂无成员</b></P></div>');
			$this->assign('empty_join','<div class="alert alert-info" role="alert"><P><b>暂无申请</b></P></div>');
			$this->display();
		}
	}

	public function plist(){
		$plist_numb = I('get.numb');
		if(!I('get.keyword')){
				$plist = M('Project')->where('allow_join=1')->order('id desc')->limit(I('get.numb'),I('get.numb')+30)->select();
				$plist_count = M('Project')->where('allow_join=1')->count();
			}else{
				if(I('get.class')=='lang'){
					$where['lang'] = array('like','%'.I('get.keyword').'%');
				}else{
					$where['name'] = array('like','%'.I('get.keyword').'%');
				}
				$plist = M('Project')->where($where)->where('allow_join=1')->order('id desc')->limit(I('get.numb'),I('get.numb')+30)->select();
				$plist_count = M('Project')->where($where)->where('allow_join=1')->count();
			}

		$this->assign('plist_numb',$plist_numb);
		$this->assign('plist_count',$plist_count);
		$this->assign('plist',$plist);
		$this->display();
	}

	public function team($pid){
		if (IS_POST) {
			if(I('post.type')=='create_talk'){
				if(D('ProjectTeamTalk')->add_new(I('post.talk_title'),I('post.talk_content'),I('post.talk_class'),$pid)){
					$this->success('发布成功');
				}else{
					$this->error('发布失败');
				}
			}elseif(I('post.type')=='create_duty'){
				if(D('ProjectTeamDuty')->add_new(I('post.duty_name'),I('post.duty_content'),$pid)){
					$this->success('创建成功');
				}else{
					$this->error('创建失败');
				}
			}elseif(I('post.type')=='create_duty_details'){
				if(D('ProjectTeamDutyDetails')->add_new(I('post.duty_name'),I('post.duty_content'),I('post.duty_id'),I('post.duty_touname'),$pid,I('post.duty_deadline'))){
					echo('指派成功');
				}else{
					echo('指派失败');
				}
			}elseif(I('post.type')=='set_active'){
				if(D('ProjectTeamDutyDetails')->set_active(I('post.details_id'),I('post.active'))){
					echo('success');
				}else{
					echo('error');
				}
			}
		}else{
				$project = M('Project')->where('id=%d',$pid)->find();
				$talk_class = M('TalkClass')->order('id')->select();
				$talk_content = M('ProjectTeamTalk')->where('pid=%d',$pid)->order('id desc')->select();
				$team_dutylist = M('ProjectTeamDuty')->where('pid=%d',$pid)->order('id desc')->select();
				$team_dutylist_my = M('ProjectTeamDutyDetails')->where('pid=%d AND touid=%d',$pid,session('user_auth_sign'))->order('id desc')->select();

				$project_content = M('Project')->where('id=%d',$pid)->find();

				$project_member = M('ProjectMember')->where('uid=%d AND pid=%d',session('user_auth_sign'),$pid)->find();
				//判断用户是否为管理员
				if($project_content['uid']==session('user_auth_sign')){
					$project_creater = 1;
					$project_admin = 1;
				}elseif($project_member['admin']==1){
					$project_creater = 0;
					$project_admin = 1;
				}else{
					$project_creater = 0;
					$project_admin = 0;
				}
				//判断用户是否为该项目会员
				if(count($project_member)) $project_is_member = true;
				else $project_is_member = false;
				$myduty_empty = '<center>还没有为你指派的任务</center>';

				$this->assign('project',$project);
				$this->assign('talk_class',$talk_class);
				$this->assign('talk_content',$talk_content);
				$this->assign('myduty_empty',$myduty_empty);
				$this->assign('team_dutylist',$team_dutylist);
				$this->assign('team_dutylist_my',$team_dutylist_my);
				$this->assign('admin',$project_admin);
				$this->assign('creater',$project_creater);
				$this->assign('is_member',$project_is_member);
				$this->display();
			}
	}
}