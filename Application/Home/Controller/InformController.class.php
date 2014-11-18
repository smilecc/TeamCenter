<?php
namespace Home\Controller;
use Think\Controller;
class InformController extends IndexController {
	public function index(){
		if(IS_POST){
			if(I('post.type')=="content"){
				$inform = D('Inform');
				if($inform->add_new(I('post.content'),I('post.class_id'),I('post.project_id'))){
					echo "发布成功";
					}
					else{
					echo "发布失败";
					}
			
			}
		}
		else {
			$inform = M('Inform');

			$creater = M('Project')->where('uid=%d',session('user_auth_sign'))->select();
			$member = M('ProjectMember')->where('uid=%d',session('user_auth_sign'))->select();
			$member_admin = M('ProjectMember')->where('uid=%d AND admin=1',session('user_auth_sign'))->select();
			$where = '';
			if(I('get.class','all')=='all' OR I('get.class')=='project'){
				for($i=0;$i<count($creater);$i++){
					$where = $where.$creater[$i]['id'].($i==(count($creater)-1)?'':' OR project_id = ');
				}
				for($i=0;$i<count($member);$i++){
					$where = $where.(!$where?'':' OR project_id = ').$member[$i]['pid'];
				}
			}

            if(I('get.class','all')=='all') {$where = '(class_id = 1)'.(!$where?'':' OR (project_id = '.''.$where.')');$page_active='all';trace($where);}
			elseif(I('get.class')=='project') {$where = '(class_id = 2) AND (project_id = '.$where.')';$page_active='project';}
			elseif(I('get.class')=='team') {$where = 'class_id = 1';$page_active='team';}
			$inform_list = $inform->where($where)->order('cid desc')->limit(I('get.numb'),I('get.numb')+30)->select();
			$inform_count = $inform->where($where)->count();
			$inform_page_numb = I('get.numb');
			$is_system_admin = M('User')->where('uid=%d',session('user_auth_sign'))->getField('admin');

			$this->assign('member_admin',$member_admin);
			$this->assign('creater',$creater);
			$this->assign('inform_list',$inform_list);
			$this->assign('page_active',$page_active);
			$this->assign('member_admin',$member_admin);
			$this->assign('is_system_admin',$is_system_admin);
			$this->assign('inform_page_numb',$inform_page_numb);
			//print_r($inform_list);
			$this->display();
			}
	}
}