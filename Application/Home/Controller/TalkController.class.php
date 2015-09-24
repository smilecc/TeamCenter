<?php
namespace Home\Controller;
use Think\Controller;
class TalkController extends Controller {
	public function index($mode=0){
		if(IS_POST){
			if(I('post.type')=='create'){
				if(D('Talk')->add_new(I('post.talk_title'),I('post.talk_content'),I('post.talk_class'))){
					$this->success('发布成功');
				}else{
					$this->error('发布失败');
				}
			}else if(I('post.type')=='register_node'){
				if(D('TalkClass')->add_new(I('post.node_name'),I('post.father'))){
					$this->success('提交成功 等待审核');
				}else{
					$this->error('提交失败');
				}
			}
		}else{
			$talk_class = M('TalkClass')->order('id')->select();
			$talk_class_display = M('TalkClass')->where('display=1')->order('id')->select();
			//trace($mode,'提示');

			if($mode==0){
				$talk_content = M('Talk')->where('project_id=0')->order('id desc')->limit(I('get.numb'),I('get.numb')+30)->select();
			}else{
				$talk_content = M('Talk')->where('project_id=0')->where('class=%d',$mode)->order('id desc')->limit(I('get.numb'),I('get.numb')+30)->select();
			}

			$talk_page_numb = I('get.numb');

			$classinfo = M('TalkClass')->where('id=%d',$mode)->find();

			$this->assign('classinfo',$classinfo);
			$this->assign('talk_page_numb',$talk_page_numb);
			$this->assign('talk_mode',$mode);
			$this->assign('talk_class',$talk_class);
			$this->assign('talk_class_display',$talk_class_display);
			$this->assign('talk_content',$talk_content);
			$this->display();
		}
	}

	public function talkpage($tid){
		if(IS_POST){
			if(I('post.type')=='create'){
				if(D('TalkComment')->add_new($tid,I('post.content'))){
					$this->success('发表成功');
				}else{
					$this->error('发表失败');
				}
			}
		}else{
		trace('user_auth_sign',session('user_auth_sign'));
		$talk_class = M('TalkClass')->where('display=1')->order('id')->select();
		$talk_pagecon = M('Talk')->where('id=%d',$tid)->find();
		$talk_count = M('TalkComment')->where('tid=%d',$tid)->count();
		$talk_comment = M('TalkComment')->where('tid=%d',$tid)->order('id')->limit(I('get.numb'),I('get.numb')+30)->select();
		$talk_page_numb = I('get.numb');

		$this->assign('tid',$tid);
		$this->assign('talk_class',$talk_class);
		$this->assign('talk_count',$talk_count);
		$this->assign('talk_comment',$talk_comment);
		$this->assign('talk_pagecon',$talk_pagecon);
		$this->assign('talk_page_numb',$talk_page_numb);
		$this->display();
	}
	}

}