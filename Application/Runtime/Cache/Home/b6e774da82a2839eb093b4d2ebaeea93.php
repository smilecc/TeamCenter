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
        <li id="about"><a href="<?php echo U('/Home/About');?>">关于</a></li>
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
	
<title><?php echo ($project['name']); ?> - 项目协作 - 社团中心</title>
<div class="container">
<div class="row">
<div class="page-header">
  <h1><?php echo ($project['name']); ?> <small>项目相关</small>
  <?php if($admin OR $is_member): ?><span style="float:right"><a href="<?php echo U('/Home/Team/'.$project['id']);?>"><button class="btn btn-success">进入协作</button></a></span><?php endif; ?>
  </h1>
</div>
	<div class="col-md-3">

<ul class="nav nav-pills nav-stacked" role="tablist">
  <li class="active"><a href="#project_setting" role="tab" data-toggle="tab">项目资料</a></li>
  <li><a href="#project_member" role="tab" data-toggle="tab">成员相关</a></li>
</ul>

	</div><!--/col-md-3-->

	<div class="col-md-9">

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane fade in active" id="project_setting">
		<form method="post" action="/Home/Project/1">
      	<input type="hidden" name="type" value="create">
      	<label class="col-sm-3 control-label">项目名称：</label>
        <?php echo ($project['name']); ?>
        <hr>
        <label class="col-sm-3 control-label">创始人：</label>
        <?php echo getUsername($project['uid']);?>
        <hr>
        <label class="col-sm-3 control-label">项目介绍：</label>
        <?php if($admin): ?><textarea id="content" class="form-control" style="width:500px;" rows="3" name="content" placeholder="请填写一些关于本项目的介绍（可选）"><?php echo ($project['content']); ?></textarea>
        <?php else: echo ($project['content']?nl2br($project['content']):'无'); endif; ?>
        <hr>
        <div>
        <label class="col-sm-3 control-label">公开性：</label>

        <?php if($admin): ?><label>
    	<input type="radio" name="allow_join" id="optionsRadios1" value="1" <?php if($project['allow_join']): ?>checked<?php endif; ?>>
    	所有人可见
  		</label>
  		<label>
    	<input type="radio" name="allow_join" id="optionsRadios2" value="0"  <?php if(!$project['allow_join']): ?>checked<?php endif; ?>>
    	只限组员可见
  		</label>
  		<?php else: if($project['allow_join']): ?>所有人可见<?php else: ?>只限组员可见<?php endif; endif; ?>
  		</div>
  		<hr>
  		<label class="col-sm-3 control-label">项目语言：</label>
  		<?php if($admin): ?><input class="form-control" style="width:300px;" type="text" name="lang" class="form-control" value="<?php echo ($project['lang']); ?>" placeholder="项目语言" required>
  		<h5>多种语言请以英文逗号隔开：","</h5>
  		<?php else: ?>
  		<?php if(is_array($project['lang_arr'])): $i = 0; $__LIST__ = $project['lang_arr'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><code><?php echo ($vo); ?></code><?php endforeach; endif; else: echo "" ;endif; endif; ?>
  		<hr>

  		<?php if($admin): ?><input type="hidden" name="type" value="update">
    	<center>
    		<button type="submit" class="btn btn-primary" style="width:130px;">提交</button>
    		<button type="button" class="btn btn-danger" style="width:130px;" data-toggle="modal" data-target="#exit_project">退出本项目</button>
    	</center>
    	<?php elseif(!$admin AND $is_member): ?>

    	<center>
    		<button type="button" class="btn btn-danger" style="width:130px;" data-toggle="modal" data-target="#exit_project">退出本项目</button>
    	</center>
    	<?php else: ?>
    	<center><button type="button" class="btn btn-success" style="width:130px;" data-toggle="modal" data-target="#join">申请加入</button></center>
    	<!-- Modal -->
<div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">申请加入项目</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="/Home/Project/1">
      	<input type="hidden" name="type" value="join">
      	<b>申请信息：</b>
        <textarea id="content" class="form-control" rows="3" name="content" placeholder="写一些对这个项目的看法吧"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
     </form>
    </div>
  </div>
</div><?php endif; ?>
    	</form>
  </div><!--/项目设置页结尾-->
  <div class="tab-pane fade" id="project_member">
  	<div class="panel panel-primary">
  		<div class="panel-heading">
    		<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span> 会员管理</h3>
  		</div>
  		<div class="panel-body">

  			<!-- Nav tabs -->
<ul class="nav nav-pills" role="tablist">
  <li class="active"><a href="#project_member_setting" role="tab" data-toggle="tab">会员管理</a></li>
  <?php if($admin): ?><li><a href="#project_admin_setting" role="tab" data-toggle="tab">申请审批</a></li><?php endif; ?>
</ul>
<hr>
<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane fade in active" id="project_member_setting">
<div class="alert alert-success" role="alert"><P>友情提示：请善用浏览器搜索功能（快捷键：Ctrl+F）</P></div>
<script type="text/javascript">
function set_member(pid,uid,type_mod){
  	$.ajax({
    	type:"POST",
   		url:"/Home/Project/1",
   		data:{
   				type:type_mod,
    			pid:pid,
    			uid:uid,
    		},
    success:function(re){
    	alert(re);
    }
    });
}
</script>
<table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>用户名</th>
          <th>身份</th>
          <th>加入时间</th>
          <?php if($admin): ?><th>操作</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
      <?php if(is_array($member_list)): $i = 0; $__LIST__ = $member_list;if( count($__LIST__)==0 ) : echo "$empty_member" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($i); ?></td>
          <td><?php echo getUsername($vo['uid']);?></td>
          <td><?php if($vo['admin']): ?>管理员<?php else: ?>会员<?php endif; ?></td>
          <td><?php echo ($vo['time']); ?></td>
          <td>
          		<?php if($creater): if(!$vo['admin']): ?><button class="btn btn-primary" onclick="set_member(<?php echo ($vo['pid']); ?>,<?php echo ($vo['uid']); ?>,'setadmin')">设为管理员</button>
          			<?php else: ?>
          			<button class="btn btn-warning" onclick="set_member(<?php echo ($vo['pid']); ?>,<?php echo ($vo['uid']); ?>,'setadmin')">取消管理员</button><?php endif; endif; ?>
          		<?php if($vo['admin'] AND $creater): ?><button class="btn btn-danger" onclick="set_member(<?php echo ($vo['pid']); ?>,<?php echo ($vo['uid']); ?>,'delete_member')">移除</button><!--非创建者不能移除管理员-->
          		<?php elseif(!$vo['admin'] AND ($creater OR $admin)): ?>
          			<button class="btn btn-danger" onclick="set_member(<?php echo ($vo['pid']); ?>,<?php echo ($vo['uid']); ?>,'delete_member')">移除</button><?php endif; ?>
          		
          </td>
        </tr><?php endforeach; endif; else: echo "$empty_member" ;endif; ?>
      </tbody>
    </table>

  </div><!--/project_member_setting-->
  <div class="tab-pane fade" id="project_admin_setting" role="alert">

<script type="text/javascript">
function join_set(join_id,allow,divid){
  	$.ajax({
    	type:"POST",
   		url:"/Home/Project/1",
   		data:{
   				join_id:join_id,
   				allow:allow,
   				type:'set_join'
    		},
    success:function(re){
    	if(re=='审批成功') $('#join_list_'+divid).alert('close');
    }
    });
}
</script>

<?php if(is_array($join_list)): $i = 0; $__LIST__ = $join_list;if( count($__LIST__)==0 ) : echo "$empty_join" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel panel-success" id="join_list_<?php echo ($i); ?>">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo getUsername($vo['uid']);?></h3>
  </div>
  <div class="panel-body">
    <p><?php echo nl2br($vo['content']);?></p>
    <p class="text-right">
    	<button class="btn btn-success" onclick="join_set(<?php echo ($vo['id']); ?>,1,<?php echo ($i); ?>)">通过</button>
    	<button class="btn btn-danger" onclick="join_set(<?php echo ($vo['id']); ?>,2,<?php echo ($i); ?>)">拒绝</button>
    </p>
  </div>
</div><?php endforeach; endif; else: echo "$empty_join" ;endif; ?>
  </div><!--/project_admin_setting-->
</div>
  		</div><!--panel-body-->
  	</div>
   </div><!--/project_member-->
</div>

	</div><!--/col-md-8-->
</div><!--/row-->
</div><!--/container-->



    	<!-- 退出 -->
<div class="modal fade" id="exit_project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">确认退出项目</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="/Home/Project/1">
      	<input type="hidden" name="type" value="exit">
      	<b>是否要退出本项目？</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-danger">确认</button>
      </div>
     </form>
    </div>
  </div>
</div>
	<!-- 退出 -->


	<!-- /主体 -->

	<!-- 底部 -->
	<div class="container">
<hr>
<footer>
&copy; Company 2014 All rights reserved - Design By <a href="http://cuican.name">崔璨</a> AND 刘伟
<!--<div class="navbar-right">
<a>联系我们</a> · 
<a>帮助中心</a>
</div>-->
<br />
</footer>
</div>

<script type="text/javascript">
  document.getElementById("space_height").style.cssText="height:"+(document.body.scrollHeight-160)+"px";
</script>
	<!-- /底部 -->
</body>
</html>