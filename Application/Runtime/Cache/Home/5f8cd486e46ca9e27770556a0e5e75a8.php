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
	
<title>公告 - <?php echo C('SITE_TITLE');?></title>
<div class="container"><!--container-->
<div class="row"><!--row-->

<div class="col-md-8"><!--col-md-8-->

<?php if(is_array($inform_list)): $i = 0; $__LIST__ = $inform_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><!--公告内容-->
<div class="panel panel-default">
  <div class="panel-body"><p><?php echo nl2br($value['content']);?></p></div>
  <div class="panel-footer">
  <div class="text-right"><a href="/Home/User/people/<?php echo ($value["uid"]); ?>" target="_blank"><?php echo getUsername($value['uid']);?></a> 于 <?php echo ($value["time"]); ?> 发布于 <b>
  <?php if($value['class_id'] == 1): ?>社团公告
  <?php elseif($value['class_id'] == 2): ?>项目公告：<a href="/Home/Project/<?php echo ($value['project_id']); ?>" target="_BLANK"><?php echo getProjectname($value['project_id']);?></a><?php endif; ?>
  </b>

  </div>
  </div>
</div><?php endforeach; endif; else: echo "" ;endif; ?>
<!--/公告内容-->

<?php if(($inform_count > ($inform_page_numb+30)) OR ($inform_count > 30)): ?><ul class="pager">
  <li class="previous <?php echo ($inform_page_numb-30<0?'disabled':''); ?>"><a href="<?php echo U('/Home/Inform/'.$page_active.'/'.($inform_page_numb-30));?>">&larr; 上一页</a></li>
  <li class="next <?php echo ($inform_page_numb+30>=$inform_count?'disabled':''); ?>"><a href="<?php echo U('/Home/Inform/'.$page_active.'/'.($inform_page_numb+30));?>">下一页 &rarr;</a></li>
</ul><?php endif; ?>

</div><!--/col-md-8-->

<div class="col-md-4" id="space_height"><!--col-md-4-->

<div class="panel panel-default"><!--发布公告-->
  <div class="panel-heading">
    <h3 class="panel-title">发布公告</h3>
  </div>
  <div class="panel-body">
    <textarea id="content" class="form-control" rows="3" name="content"></textarea>
    <p>请输入少于240字的公告</p>
    <hr>
    <div class="text-right">
    <!-- 发布按钮 -->
<script type="text/javascript">
function inform_submit(class_id,project_id){
  $.ajax({
            type:"POST",
            url:"<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>",
            data:{
                  content:$("#content").val(),
                  class_id:class_id,
                  project_id:project_id,
                  type:"content"
                  },
            success:function(re){
                alert(re);
                if(re=="发布成功"){
                  location.replace(location);
                }
            }
  });
}
</script>
<div class="btn-group">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    请选择所发布的类 <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
  <?php if($is_system_admin): ?><li><a href="#" onclick="inform_submit(1)">社团公告</a></li><?php endif; ?>
    <li class="divider"></li>
    <?php if(is_array($creater)): $i = 0; $__LIST__ = $creater;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="#" onclick="inform_submit(2,<?php echo ($vo["id"]); ?>)"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if(is_array($member_admin)): $i = 0; $__LIST__ = $member_admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li><a href="#" onclick="inform_submit(2,<?php echo ($vol["pid"]); ?>)"><?php echo getProjectname($vol["pid"]);?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
</div>
	<!-- /发布按钮 -->
    </div>
  </div>
</div><!--/发布公告-->


<!--分类-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">公告列表</h3>
  </div>
  <div class="panel-body">
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li role="presentation" id="page_all"><a href="<?php echo U('/Home/Inform/all/');?>">全部</a></li>
  <li role="presentation" id="page_team"><a href="<?php echo U('/Home/Inform/team/');?>">社团公告</a></li>
  <li role="presentation" id="page_project"><a href="<?php echo U('/Home/Inform/project/');?>">项目公告</a></li>
</ul>
  </div>
</div>
<!--/分类-->

</div><!--/col-md-4-->

</div><!--/row-->
</div><!--/container-->
<script type="text/javascript">
  document.getElementById("inform").className="active";
  document.getElementById("page_<?php echo ($page_active); ?>").className="active";
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