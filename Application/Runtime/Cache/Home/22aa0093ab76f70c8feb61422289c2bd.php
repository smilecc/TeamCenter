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
	
<title>资源共享 - 社团中心</title>
<div class="container">
<div class="row">
	<div class="col-md-9">
  <?php if(is_array($res_content)): $i = 0; $__LIST__ = $res_content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h4><a href="<?php echo U('/Home/Respage/'.$vo['id']);?>" target="_BLANK"><?php echo ($vo['name']); ?></a><span style="float:right"><span class="glyphicon glyphicon-user"></span> <?php echo getUsername($vo['uid']);?></span></h4>
   <small><?php echo mb_substr($vo['content'],0,100,"utf8");?>...<span style="float:right"><span class="glyphicon glyphicon-book"></span> <?php echo getResclassname($vo['class']);?></span></small>
   <hr><?php endforeach; endif; else: echo "" ;endif; ?>

<ul class="pager">
  <li class="previous <?php echo ($res_page_numb-30<0?'disabled':''); ?>"><a href="<?php echo U('/Home/Res.html/'.$res_mode.'/'.($res_page_numb-30));?>">&larr; 上一页</a></li>
  <li class="next"><a href="<?php echo U('/Home/Res.html/'.$res_mode.'/'.($res_page_numb+30));?>">下一页 &rarr;</a></li>
</ul>

  </div><!--col-md-9-->
	<div class="col-md-3" id="space_height">
	<div class="alert alert-success" role="alert">
		<h4>提示</h4>
		<p>本站不提供资源上传服务，旨在让大家分享各路资源。</p>
	</div><!--提示框-->

<!--资料列表-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">资源类目</h3>
  </div>
  <div class="panel-body">
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li role="presentation" id="res_0"><a href="<?php echo U('/Home/Res.html/0/');?>">所有</a></li>
  <?php if(is_array($res_class)): $i = 0; $__LIST__ = $res_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li role="presentation" id="res_<?php echo ($vo['id']); ?>"><a href="<?php echo U('/Home/Res.html/'.$vo['id']);?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<hr>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">分享新资源</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="/index.php/Home/Res.html">
      	<input type="hidden" name="type" value="create">
        <input class="form-control" style="width:300px;" type="text" name="res_name" class="form-control" placeholder="资源名称" required>
        <br />
        <input class="form-control" style="width:300px;" type="text" name="res_url" class="form-control" placeholder="资源地址/URL" required>        <br />
          <div class="alert alert-success" role="alert">
            <p>本站不提供资源上传服务，旨在让大家分享各路资源，如需上传文件，推荐使用<a href="http://pan.baidu.com" target="_BLANK">百度网盘</a>上传后分享链接到此。</p>
          </div><!--提示框-->
        <textarea id="content" class="form-control" rows="3" name="res_content" placeholder="请填写一些关于这个资源的介绍（可选）"></textarea>
        <br />
  		<select multiple class="form-control" name="res_class">
      <?php if(is_array($res_class)): $i = 0; $__LIST__ = $res_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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

<center><button class="btn btn-primary" data-toggle="modal" data-target="#create">分享新资源</button></center>

  </div>
</div>
<!--/资料列表-->

	</div><!--col-md-3-->
</div><!--row-->
</div><!--container-->

<script type="text/javascript">
  document.getElementById("res").className="active";
  document.getElementById("res_<?php echo ($res_mode); ?>").className="active";
</script>

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