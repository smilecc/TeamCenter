<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">

    <!-- Bootstrap -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
<style type="text/css">
button,p,h1,h2,h3,h4,h5,h6,a,td,small {
font-family:Microsoft YaHei;
}
</style>
</head>
<body>
	<!-- 头部 -->
	
<style type="text/css">
body {
  padding-top: 70px;
  padding-bottom: 20px;
}
</style>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/" style="font-family:Microsoft YaHei">社团中心</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <!--<li id="index"><a href="/">首页</a></li>--> <!-- class="active"-->
			<li id="inform"><a href="<?php echo U('/Home/Inform');?>">公告</a></li>
    	<li id="res"><a href="<?php echo U('/Home/Res');?>">资源</a></li>
			<li id="talk"><a href="<?php echo U('/Home/Talk');?>">讨论</a></li>
			<li id="member"><a href="<?php echo U('/Home/Member');?>">成员</a></li>
      <li class="dropdown" id="project">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">项目协作 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo U('/Home/Project');?>"><span class="glyphicon glyphicon-home"></span> 我的项目</a></li>
            <li><a href="<?php echo U('/Home/Projectlist');?>"><span class="glyphicon glyphicon-th-list"></span> 项目列表</a></li>
          </ul>
        </li>
          </ul>

<?php if(is_login()): ?><ul class="nav navbar-nav navbar-right">
        			<li class="dropdown">
          			<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-bottom:0px;">
					<img src="<?php echo return_display(session('user_auth_sign'));?>" alt="display" class="img-rounded" style="width:25px;height:25px;" />
					<?php echo cookie('user_name');?> <?php if(getInboxalert()): ?><span class="badge"><?php echo getInboxalert();?></span><?php endif; ?>
          			<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo U('/Home/User/people');?>/<?php echo cookie('user_id');?>"><span class="glyphicon glyphicon-home"></span>  我的主页</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo U('/Home/Inbox');?>"><span class="glyphicon glyphicon-envelope"></span>  私信 <?php if(getInboxalert()): ?><span class="badge"><?php echo getInboxalert();?></span><?php endif; ?></a></li>
    				<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo U('/Home/User/settings');?>"><span class="glyphicon glyphicon-cog"></span>  设置</a></li>
    				<!--内容中心-->
					<!--<li role="presentation" class="divider"></li><li role="presentation"><a role="menuitem" tabindex="-1" href="/system/content"><span class="glyphicon glyphicon-hdd"></span>  内容中心</a></li>-->
					<!--/内容中心-->
					<li role="presentation" class="divider"></li>
    				<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo U('/Home/User/logout');?>"><span class="glyphicon glyphicon-off"></span>  退出登录</a></li>
  					</ul></li></ul>
<?php else: ?>
		  <form class="navbar-form navbar-right" role="form" action="/member/login.php" method="post">
            <!--<div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password" required>
            </div>
            <button type="submit " class="btn btn-success">登录</button>-->
            <a class="btn btn-success" role="button" href="<?php echo U('/Home/User/login');?>">登录</a>
            <a class="btn btn-primary" role="button" href="<?php echo U('/Home/User/register');?>">注册</a>
          </form>
          <script type="text/javascript">window.location.href="/Home/User/login";</script><?php endif; ?>

		</div><!--/.navbar-collapse -->
      </div>
    </div>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
<title><?php echo ($project['name']); ?> - 项目协作</title>
<div class="container">
<div class="col-md-3" id="space_height">
<div class="alert alert-success" role="alert"><h4>提示</h4><p>善用任务分配能提高团队效能。</p></div>
<!-- Nav tabs -->
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li class="active"><a href="#team_talk" role="tab" data-toggle="tab">讨论</a></li>
  <li><a href="#team_duty" role="tab" data-toggle="tab">任务</a></li>
</ul>

</div><!--col-md-3-->
<div class="col-md-9">
<div class="page-header">
  <h1><?php echo ($project['name']); ?> <small>项目协作</small></h1>
</div>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane fade in active" id="team_talk">

<!-- Modal -->
<div class="modal fade" id="team_create_talk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">创建一个新讨论</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="/index.php/Home/Team/3.html">
      	<input type="hidden" name="type" value="create_talk">
        <input class="form-control" style="width:300px;" type="text" name="talk_title" class="form-control" placeholder="讨论主题" required>
        <br />
        <textarea id="content" class="form-control" rows="3" name="talk_content" placeholder="请填写关于这个讨论的内容" required></textarea>
        <br />
  		<select multiple class="form-control" name="talk_class">
      <?php if(is_array($talk_class)): $i = 0; $__LIST__ = $talk_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
     </form>
    </div>
  </div>
</div>


  	<h4>讨论 <button class="btn btn-success" data-toggle="modal" data-target="#team_create_talk">发起新的讨论</button></h4>
  	<hr>

  <?php if(is_array($talk_content)): $i = 0; $__LIST__ = $talk_content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h4><a href="<?php echo U('/Home/Talkpage/'.$vo['tid']);?>" target="_BLANK"><?php echo getTalktitle($vo['tid']);?></a><span style="float:right"><span class="glyphicon glyphicon-user"></span> <?php echo getUsername($vo['uid']);?></span></h4>
   <small><div style="float:right"><?php echo ($vo['time']); ?></div></small>
   <hr><?php endforeach; endif; else: echo "" ;endif; ?>

  </div><!--team_talk-->
  <div class="tab-pane fade" id="team_duty">
  	
<!-- Modal -->
<div class="modal fade" id="team_create_duty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">创建新的任务清单</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="/index.php/Home/Team/3.html">
      	<input type="hidden" name="type" value="create_duty">
        <input class="form-control" style="width:300px;" type="text" name="duty_name" class="form-control" placeholder="清单名称" required>
        <br />
        <textarea id="content" class="form-control" rows="3" name="duty_content" placeholder="请填写关于这个清单的介绍" required></textarea>
        <br />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
     </form>
    </div>
  </div>
</div>


  	<h4>任务<?php if($admin): ?><button class="btn btn-success" data-toggle="modal" data-target="#team_create_duty">创建新的任务清单</button><?php endif; ?></h4>
  	<hr>


<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#duty_my" role="tab" data-toggle="tab">我的任务</a></li>
  <li><a href="#duty_all" role="tab" data-toggle="tab">所有清单</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="duty_my">
<script type="text/javascript">
function set_active(details_id,active){
  $.ajax({
            type:"POST",
            url:"/index.php/Home/Team/3.html",
            data:{
                	details_id:details_id,
                	active:active,
                  	type:"set_active"
                  },
            success:function(re){
                if(re=='success'){
                		if(active==0) var span_con = '[未进行]';
						if(active==1) var span_con = '[进行中]';
						if(active==2) var span_con = '[已完成]';
						document.getElementById('span_myduty_'+details_id).innerHTML=span_con;
                }else{
                	alert('修改失败');
                }
            }
  });
}
</script>
<br />
<div class="panel-group" id="myduty" role="tablist" aria-multiselectable="true">
<?php if(is_array($team_dutylist_my)): $i = 0; $__LIST__ = $team_dutylist_my;if( count($__LIST__)==0 ) : echo "$myduty_empty" ;else: foreach($__LIST__ as $key=>$myvo): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#myduty" href="#mylist_<?php echo ($i); ?>" aria-expanded="true" aria-controls="mylist_<?php echo ($i); ?>"><?php trace($myvo['active']); ?>
        <span id="span_myduty_<?php echo ($myvo['id']); ?>">
          <?php if($myvo['active'] == 0): ?>[未进行]
          <?php elseif($myvo['active'] == 1): ?>[进行中]
          <?php elseif($myvo['active'] == 2): ?>[已完成]<?php endif; ?></span><?php echo ($myvo['name']); ?> - <?php echo getDutyname($myvo['duty_id']);?>
        </a>
      </h4>
    </div>
    <div id="mylist_<?php echo ($i); ?>" class="panel-collapse collapse" role="tabpanel">
      <div class="panel-body">
        <b>任务内容：</b><?php echo ($myvo['content']); ?><br />
        <b>任务指派人：</b><?php echo getUsername($myvo['uid']);?><br />
        <b>指派时间：</b><?php echo ($myvo['time']); ?><br />
        <b>完成日期：</b><?php echo ($myvo['deadline']=='0000-00-00'?'无要求':$myvo['deadline']); ?><br />
        <hr>
        <div class="text-right">
        	<button class="btn btn-danger" onclick="set_active(<?php echo ($myvo['id']); ?>,0)"><span class="glyphicon glyphicon-stop"></span></button>
        	<button class="btn btn-info" onclick="set_active(<?php echo ($myvo['id']); ?>,1)"><span class="glyphicon glyphicon-play"></span></button>
        	<button class="btn btn-success" onclick="set_active(<?php echo ($myvo['id']); ?>,2)"><span class="glyphicon glyphicon-ok"></span></button>
        </div>
      </div>
    </div>
  </div><?php endforeach; endif; else: echo "$myduty_empty" ;endif; ?>
</div>

  </div>
  <div class="tab-pane" id="duty_all">
<?php if($admin): ?><script type="text/javascript">
function duty_submit(){
  $.ajax({
            type:"POST",
            url:"/index.php/Home/Team/3.html",
            data:{
          			duty_name:$("#duty_details_name").val(),
                	duty_content:$("#duty_details_content").val(),
                	duty_id:$("#duty_details_dutyid").val(),
                	duty_touname:$("#duty_details_touname").val(),
                	duty_deadline:$("#duty_details_deadline").val(),
                  	type:"create_duty_details"
                  },
            success:function(re){
                alert(re);
                if(re=="指派成功"){
                  location.replace(location);
                }
            }
  });
}
</script>

      <!-- Modal -->
<div class="modal fade" id="team_duty_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">为成员指派任务</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" name="type" value="create_duty_details">
        <input class="form-control" style="width:300px;" type="text" name="duty_name" id="duty_details_name" class="form-control" placeholder="任务名称" required>
        <br />
        <textarea class="form-control" rows="3" name="duty_content" id="duty_details_content" placeholder="请填写关于这个任务的内容" required></textarea>
        <br />
        <input class="form-control" style="width:300px;" type="text" name="duty_tousername" id="duty_details_touname" class="form-control" placeholder="指派给的成员用户名" required>
        <br />
        <input class="form-control" style="width:300px;" type="text" name="duty_deadline" id="duty_details_deadline" class="form-control" placeholder="完成日期（选填）">
        <input type="hidden" id="duty_details_dutyid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="duty_submit()">提交</button>
      </div>
    </div>
  </div>
</div><?php endif; ?>

<br />
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php if(is_array($team_dutylist)): $i = 0; $__LIST__ = $team_dutylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ($i); ?>" aria-expanded="true" aria-controls="collapse<?php echo ($i); ?>">
          <?php echo ($vo['name']); ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo ($i); ?>" class="panel-collapse collapse" role="tabpanel">
      <div class="panel-body">
      <b>介绍：</b><?php echo nl2br($vo['content']);?><br />
	  <b>清单创建人：</b><?php echo getUsername($vo['uid']);?>
      <?php if($admin): ?><br /><button class="btn btn-success" data-toggle="modal" value="<?php echo ($vo['id']); ?>" data-target="#team_duty_details" onclick="$('#duty_details_dutyid').val($(this).val())">指派任务</button><?php endif; ?>
      <hr>
      <?php $team_dutylist_con = M('ProjectTeamDutyDetails')->where('duty_id=%d',$vo['id'])->order('id desc')->select(); ?>

<div class="panel-group" id="con_list" role="tablist" aria-multiselectable="true">
<?php if(is_array($team_dutylist_con)): $con_i = 0; $__LIST__ = $team_dutylist_con;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$con): $mod = ($con_i % 2 );++$con_i;?><div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#con_list" href="#con_<?php echo ($i); ?>_<?php echo ($con_i); ?>" aria-expanded="true" aria-controls="con_<?php echo ($con_i); ?>">
          <?php if($con['active'] == 0): ?>[未进行]
          <?php elseif($con['active'] == 1): ?>[进行中]
          <?php else: ?>[已完成]<?php endif; ?>
          <?php echo ($con['name']); ?>
        </a>
      </h4>
    </div>
    <div id="con_<?php echo ($i); ?>_<?php echo ($con_i); ?>" class="panel-collapse collapse" role="tabpanel">
      <div class="panel-body">
        <b>任务内容：</b><?php echo ($con['content']); ?><br />
        <b>任务指派人：</b><?php echo getUsername($con['uid']);?><br />
        <b>被指派人：</b><?php echo getUsername($con['touid']);?><br />
        <b>指派时间：</b><?php echo ($con['time']); ?><br />
        <b>完成日期：</b><?php echo ($con['deadline']=='0000-00-00'?'无要求':$con['deadline']); ?><br />
      </div>
    </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

       <!--body-->
      </div>
    </div>
  </div><!--panel end--><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

  </div><!--duty_all-->
</div><!--tab-content-->


  </div><!--team_duty-->
</div>


</div><!--col-md-9-->
</div><!--container-->


	<!-- /主体 -->

	<!-- 底部 -->
	<div class="container">
<hr>
<footer>
&copy; Company 2014 All rights reserved - Design By <a href="http://weibo.com/smilexc8">璨</a>
<div class="navbar-right">
<a>联系我们</a> · 
<a>帮助中心</a>
</div>
<br />
</footer>
</div>

<script type="text/javascript">
  document.getElementById("space_height").style.cssText="height:"+(document.body.scrollHeight-160)+"px";
</script>
	<!-- /底部 -->
</body>
</html>