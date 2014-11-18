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
	

<title><?php echo ($talk_pagecon['title']); ?> - 讨论中心</title>
<div class="container">

<div class="page-header">
  <h3><?php echo ($talk_pagecon['title']); ?><br />
  <small><span class="glyphicon glyphicon-user"></span> <?php echo getUsername($talk_pagecon['uid']);?>  <span class="glyphicon glyphicon-comment"></span> <?php echo getTalkclassname($talk_pagecon['class']);?></small></h3>
</div>

<div class="row">
	<div class="col-md-9">
<p><?php echo nl2br($talk_pagecon['content']);?></p>
<small><p class="text-right"><b>主题内容</b> <?php echo ($talk_pagecon['time']); ?></p></small>
<hr>

<?php if(is_array($talk_comment)): $i = 0; $__LIST__ = $talk_comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><b><?php echo getUsername($vo['uid']);?>：</b>
<p><?php echo nl2br($vo['content']);?></p>
<small><p class="text-right"><b>#<?php echo ($i+$talk_page_numb); ?></b> <?php echo ($vo['time']); ?></p></small>
<hr><?php endforeach; endif; else: echo "" ;endif; ?>

<?php if(($talk_count > ($talk_page_numb+30)) OR ($talk_count > 30)): ?><ul class="pager">
  <li class="previous <?php echo ($talk_page_numb-30<0?'disabled':''); ?>"><a href="<?php echo U('/Home/Talkpage/'.$tid.'/'.($talk_page_numb-30));?>">&larr; 上一页</a></li>
  <li class="next <?php echo ($talk_page_numb+30>=$talk_count?'disabled':''); ?>"><a href="<?php echo U('/Home/Talkpage/'.$tid.'/'.($talk_page_numb+30));?>">下一页 &rarr;</a></li>
</ul><?php endif; ?>

<form method="post" action="/index.php/Home/Talkpage/4.html">
<input type="hidden" name="type" value="create">
<div class="col-md-10"><textarea id="content" class="form-control" rows="3" name="content" placeholder="评论些什么吧" required></textarea>
</div>
<div><button type="submit" class="btn btn-success">提交</button></div>
</form>

	</div><!--col-md-9-->
	<div class="col-md-3">

<!--资料列表-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">讨论类目</h3>
  </div>
  <div class="panel-body">
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li role="presentation" id="talk_0"><a href="<?php echo U('/Home/Talk.html/0/');?>">所有</a></li>
  <?php if(is_array($talk_class)): $i = 0; $__LIST__ = $talk_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li role="presentation" id="talk_<?php echo ($vo['id']); ?>"><a href="<?php echo U('/Home/Talk.html/'.$vo['id']);?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

  </div>
</div>
<!--/资料列表-->

	</div><!--col-md-3-->
</div><!--row-->
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