<?php
namespace Home\Controller;
use Think\Controller;
class InboxController extends Controller {
  public function index(){
    if(IS_POST){
        if(I('post.type')=='send'){
          if(D('Inbox')->send(I('post.toname'),I('post.content'))){
            echo '发送成功';
          }else{
            echo '发送失败';
          }
        }
    }else{
        D('InboxAlert')->clean();
        $uid = session('user_auth_sign');
        $inbox_index = M('InboxIndex')->where('uid1=%d or uid2=%d',$uid,$uid)->order('unix_timestamp(time) desc')->select();
        trace($inbox_index);

        $this->assign('inbox_index',$inbox_index);
        $this->display();
      }
  }

  public function inboxpage($uid){
    if(IS_POST){

    }else{
      $uid1 = session('user_auth_sign');
      $uid2 = $uid;
      gtuid($uid1,$uid2);
      $inboxpage_con = M('Inbox')->where('uid1=%d AND uid2=%d',$uid1,$uid2)->order('id desc')->select();

      $this->assign('uid',$uid);
      $this->assign('inboxpage_con',$inboxpage_con);
      $this->display();
    }
  }
}