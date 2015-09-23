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
	
<title><?php echo ($user_info['username']); ?> 的主页 - <?php echo C('SITE_TITLE');?></title>

<div class="container">
<div class="row">

<div class="col-md-9">
  
<div class="page-header">
  <h1><?php echo ($user_info['username']); ?> <small>的个人主页</small></h1>
</div>

<div class="panel panel-default">
  <div class="panel-body">
    <h4><p>个人介绍：<?php echo ($user_info['content']?$user_info['content']:'无'); ?></p></h4>
  <p><?php echo $pagecon[0]['geqian']; ?></p>
  <hr>
  <p><span class="glyphicon glyphicon-user"></span>
  <?php if($user_info['sex']): ?>汉子
  <?php else: ?>
  妹子<?php endif; ?>

  <span class="glyphicon glyphicon-calendar"> </span> <?php echo ($user_info['birthday']); ?></p>

  </div>
  <div class="panel-footer text-right">
  <!--<p>共获得 <span class="glyphicon glyphicon-heart"></span> <b><?php echo ($user_info['love']); ?></b> 个赞</p>-->
  <?php if($user_info['uid'] != cookie('user_id')): ?><a href="<?php echo U('/Home/Inboxpage/'.$user_info['uid']);?>"><button class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> 私信TA</button></a>
  <?php else: ?>
  <button class="btn btn-success disabled"><span class="glyphicon glyphicon-envelope"></span> 我自己</button><?php endif; ?>
  </div>
</div><!--panel-->

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#ta_res" role="tab" data-toggle="tab">TA所分享的资料</a></li>
  <li><a href="#ta_talk" role="tab" data-toggle="tab">TA所开启的讨论</a></li>
  <li><a href="#ta_project" role="tab" data-toggle="tab">TA所参加的项目</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="ta_res">
<table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>资源名</th>
          <th>资源类别</th>
          <th>发布时间</th>
        </tr>
      </thead>
      <tbody>
      <?php if(is_array($ta_res)): $i = 0; $__LIST__ = $ta_res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($i); ?></td>
          <td><a href="<?php echo u('/Home/Respage/'.$vo['id']);?>"><?php echo ($vo['name']); ?></a></td>
          <td><?php echo getResclassname($vo['class']);?></td>
          <td><?php echo ($vo['time']); ?></td>
        </tr>
      </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div><!--ta_res-->
  <div class="tab-pane" id="ta_talk">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>标题</th>
          <th>所属列别</th>
          <th>开启时间</th>
        </tr>
      </thead>
      <tbody>
      <?php if(is_array($ta_talk)): $i = 0; $__LIST__ = $ta_talk;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($i); ?></td>
          <td><a href="<?php echo u('/Home/Talkpage/'.$vo['id']);?>"><?php echo ($vo['title']); ?></a></td>
          <td><?php echo getTalkclassname($vo['class']);?></td>
          <td><?php echo ($vo['time']); ?></td>
        </tr>
      </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div><!--ta_talk-->
  <div class="tab-pane" id="ta_project">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Project_ID</th>
          <th>名称</th>
          <th>身份</th>
        </tr>
      </thead>
      <tbody>
      <?php if(is_array($ta_project)): $i = 0; $__LIST__ = $ta_project;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo['id']); ?></td>
          <td><a href="<?php echo u('/Home/Project/'.$vo['id']);?>"><?php echo ($vo['name']); ?></a></td>
          <td>创始人</td>
        </tr>
      </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
      <?php if(is_array($ta_project_member)): $i = 0; $__LIST__ = $ta_project_member;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo['pid']); ?></td>
          <td><a href="<?php echo u('/Home/Project/'.$vo['id']);?>"><?php echo getProjectname($vo['pid']);?></a></td>
          <td><?php echo ($vo['admin']?'管理员':'成员'); ?></td>
        </tr>
      </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
  </div><!--ta_project-->
</div>

</div><!--col-md-9-->

<div class="col-md-3" id="space_height"></div><!--col-md-3-->



</div><!--row-->
</div><!--container-->


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