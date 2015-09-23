<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">

    <!-- Bootstrap -->
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Public/css/bootstrap-select.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/Public/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/js/bootstrap-select.js"></script>
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
          <a class="navbar-brand" href="/" style="font-family:Microsoft YaHei"><?php echo C('SITE_TITLE');?></a>
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
	
<style type="text/css">
.form-create {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-project a:hover{
  TEXT-DECORATION:none;
}
</style>
<title>项目协作 - <?php echo C('SITE_TITLE');?></title>
<div class="container"><!--container-->
<div class="row"><!--row-->
	<div class="col-md-9">
  <?php if(is_array($creater)): $i = 0; $__LIST__ = $creater;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-3 form-project">
      <a href="/Home/Project/<?php echo ($vo['id']); ?>" target="_BLANK"><div class="well well-lg">
        <div style="height:80px;"><h4><?php echo ($vo['name']); ?><br /><small>项目ID：<?php echo ($vo['id']); ?></small></h4></div>
        <p><span class="glyphicon glyphicon-user"></span> 创始人</p>
      </div></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
  <?php if(is_array($member)): $i = 0; $__LIST__ = $member;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-3 form-project">
      <a href="/Home/Project/<?php echo ($vo['pid']); ?>" target="_BLANK"><div class="well well-lg">
        <div style="height:80px;"><h4><?php echo getProjectname($vo['pid']);?><br /><small>项目ID：<?php echo ($vo['pid']); ?></small></h4></div>
        <p><span class="glyphicon glyphicon-user"></span> <?php echo ($vo['admin']?'管理员':'会员'); ?></p>
      </div></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div><!--/col-md-8-->
	<div class="col-md-3" id="space_height">
<script type="text/javascript">
  function go_pid(){
    window.location.href="/Home/Project/"+$("#go_pid").val();
  }
</script>
    <div class="input-group">
      <input type="text" class="form-control" id="go_pid" placeholder="输入项目ID以进入项目页">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="go_pid()">Go!</button>
      </span>
    </div><!-- /input-group -->
<hr>

<!--项目列表-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">我的项目</h3>
  </div>
  <div class="panel-body">
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li role="presentation" id="project_index_all"><a href="<?php echo U('/Home/Project.html/all/');?>">所有</a></li>
  <li role="presentation" id="project_index_creater"><a href="<?php echo U('/Home/Project.html/creater/');?>">我所创建的</a></li>
  <li role="presentation" id="project_index_admin"><a href="<?php echo U('/Home/Project.html/admin/');?>">我是管理的</a></li>
  <li role="presentation" id="project_index_member"><a href="<?php echo U('/Home/Project.html/member/');?>">我是成员的</a></li>
</ul>
<hr>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">创建项目</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>">
      	<input type="hidden" name="type" value="create">
        <input class="form-control" style="width:300px;" type="text" name="name" class="form-control" placeholder="项目名称" required>
        <br />
        <textarea id="content" class="form-control" rows="3" name="content" placeholder="请填写一些关于本项目的介绍（可选）"></textarea>
        <br />
        <div>
        <label class="col-sm-2 control-label">公开性：</label>
        <label>
    	<input type="radio" name="allow_join" id="optionsRadios1" value="1" checked>
    	所有人可见
  		</label>
  		<label>
    	<input type="radio" name="allow_join" id="optionsRadios2" value="0">
    	只限组员可见
  		</label>
  		</div>
  		<input class="form-control" style="width:300px;" type="text" name="lang" class="form-control" placeholder="项目语言" required>
  		<h5>多种语言请以英文逗号隔开：","</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
     </form>
    </div>
  </div>
</div>

<center><button class="btn btn-primary" data-toggle="modal" data-target="#create">创建一个项目</button></center>

  </div>
</div>
<!--/项目列表-->
	</div>
</div><!--/container-->
</div><!--/row-->

<script type="text/javascript">
  document.getElementById("project").className="active";
  document.getElementById("<?php echo ($project_index_active); ?>").className="active";
</script>


	<!-- /主体 -->

	<!-- 底部 -->
	<div class="container">
<hr>
<footer>
&copy; Company 2014-2015 All rights reserved - Design By <a href="http://cuican.name">璨</a>
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