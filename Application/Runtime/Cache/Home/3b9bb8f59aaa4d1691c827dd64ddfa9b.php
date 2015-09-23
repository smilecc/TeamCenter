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
	
<title>关于 - <?php echo C('SITE_TITLE');?></title>
    <div class="container bs-docs-container">
      <div class="row">
        <div class="col-md-3">
          <div class="bs-sidebar hidden-print" role="complementary">
            <ul class="nav bs-sidenav">
                                  
                <li>
	<a href="#history">起源</a>
	</li>
	<li>
		<a href="#team">开发小组</a>
	</li>
  <li>
    <a href="#code">开发说明</a>
  </li>
	<li>
		<a href="#open_code">开源说明</a>
	</li>
            </ul>
          </div>
        </div>
        <div class="col-md-9" role="main">
          


<!-- History
================================================== -->
<div class="bs-docs-section">
  <div class="page-header">
    <h1 id="history">起源</h1>
  </div>
  <p class="lead">本应用是由<a href="http://weibo.com/smilexc8">璨</a>在闲暇时间开发的，从无到有共花费了十多天。</p>
  <p>最初<a href="http://weibo.com/smilexc8">璨</a>看到社团内用Q群来通知信息，觉得这种方法非常笨重，而且不易于组员交流、讨论，于是萌发了动手写这么一个平台的想法，前前后后做了十几天，终于大致做完。</p>
 
</div>


<!-- Team
================================================== -->
<div class="bs-docs-section">
  <div class="page-header">
    <h1 id="team">核心开发小组</h1>
  </div>
  <p class="lead">本站由核心开发小组维护，也欢迎大家加入我们。</p>
  <div class="list-group bs-team">
    <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>称呼</th>
            <th>主页</th>
          </tr>
        </thead>
        <tbody>
            
            <tr><td>1</td><td>崔璨</td>
                <td><a target="_blank" href="http://cuican.name">璨的博客</a></td>
          </tr>
          <tr><td>2</td><td>胡永浩</td>
              <td><a target="_blank" href="http://weibo.com/u/3243542793">他的新浪微博</a></td>
          </tr>

            </tbody>
      </table>
  </div>
  
</div>


<!-- code
================================================== -->
<div class="bs-docs-section">
  <div class="page-header">
    <h1 id="code">开发说明</h1>
  </div>
  <p class="lead">本站使用PHP开发，使用了如下框架：</p>
    <p>前端框架：<a href="http://www.bootcss.com">Bootstrap</a></p>
    <p>后端框架：<a href="http://www.thinkphp.cn">ThinkPHP</a></p>
</div>



<!-- open_code
================================================== -->
<div class="bs-docs-section">
  <div class="page-header">
    <h1 id="open_code">开源说明</h1>
  </div>
    <p class="lead">源码在Github进行公开：<br />地址：<a href="https://github.com/smilecc/TeamCenter">https://github.com/smilecc/TeamCenter</a></p>
</div>

        </div>
      </div>

    </div>



      
    <!-- Main jumbotron for a primary marketing message or call to action -->

        
        <div class="container">
     <!-- /container -->

      </div>

<script type="text/javascript">
  document.getElementById("about").className="active";
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