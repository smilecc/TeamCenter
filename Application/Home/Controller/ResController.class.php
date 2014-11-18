<?php
namespace Home\Controller;
use Think\Controller;
class ResController extends Controller {
	public function index($mode=0){
		if(IS_POST){
			if(I('post.type')=='create'){
				if(D('Res')->add_new(I('post.res_name'),I('post.res_content'),I('post.res_class'),I('post.res_url'))){
					$this->success('发布成功');
				}else{
					$this->error('发布失败');
				}
			}
		}else{
			$res_class = M('ResClass')->order('id')->select();
			//trace($mode,'提示');

			if($mode==0){
				$res_content = M('Res')->order('id desc')->limit(I('get.numb'),I('get.numb')+30)->select();
			}else{
				$res_content = M('Res')->where('class=%d',$mode)->order('id desc')->limit(I('get.numb'),I('get.numb')+30)->select();
			}

			$res_page_numb = I('get.numb');
			$this->assign('res_page_numb',$res_page_numb);

			$this->assign('res_mode',$mode);
			$this->assign('res_content',$res_content);
			$this->assign('res_class',$res_class);
			$this->display();
		}
	}

	public function respage($rid){
		$respage_content = M('Res')->where('id=%d',$rid)->find();
		$respage_class = M('ResClass')->where('id=%d',$respage_content['class'])->find();

		$this->assign('respage_class',$respage_class);
		$this->assign('respage_content',$respage_content);
		$this->display();
	}
}