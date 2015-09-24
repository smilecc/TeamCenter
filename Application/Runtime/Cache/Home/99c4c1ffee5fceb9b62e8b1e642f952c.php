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
	

<title>讨论中心 - <?php echo C('SITE_TITLE');?></title>
<div class="container">
<div class="row">
	<div class="col-md-9">
  <?php if(is_array($talk_content)): $i = 0; $__LIST__ = $talk_content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h4><a href="<?php echo U('/Home/Talkpage/'.$vo['id']);?>" target="_BLANK"><?php echo ($vo['title']); ?></a><span style="float:right"><span class="glyphicon glyphicon-user"></span> <?php echo getUsername($vo['uid']);?></span></h4>
   <small><?php echo mb_substr($vo['content'],0,100,"utf8");?>...<span style="float:right"><span class="glyphicon glyphicon-comment"></span> <?php echo getTalkclassname($vo['class']);?></span></small>
   <hr><?php endforeach; endif; else: echo "" ;endif; ?>

<ul class="pager">
  <li class="previous <?php echo ($talk_page_numb-30<0?'disabled':''); ?>"><a href="<?php echo U('/Home/Talk.html/'.$talk_mode.'/'.($talk_page_numb-30));?>">&larr; 上一页</a></li>
  <li class="next"><a href="<?php echo U('/Home/Talk.html/'.$talk_mode.'/'.($talk_page_numb+30));?>">下一页 &rarr;</a></li>
</ul>

  </div><!--col-md-9-->
	<div class="col-md-3" id="space_height">

<!--info-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">节点信息</h3>
  </div>
  <div class="panel-body">
    <strong>节点名：</strong><?php echo getTalkclassname($talk_mode);?><br/>
    <strong>主题量：</strong><?php echo getTalkclassCount($talk_mode);?><br/>
    <strong>父节点：</strong><a href="<?php echo U('/Home/Talk.html/'.$classinfo['father']);?>"><?php echo getTalkclassname($classinfo['father']);?></a>
    </div>
  </div>

<!--全部节点-->
<div class="modal fade" id="allNodeDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">全部节点</h4>
      </div>
      <div class="modal-body">
        <?php if(is_array($talk_class)): $i = 0; $__LIST__ = $talk_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a type="button" href="<?php echo U('Home/Talk/'.$vo['id']);?>" class="btn btn-default btn-xs"><?php echo $vo['name'];?></a> </span><?php endforeach; endif; else: echo "" ;endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>` 
      </div>
     </form>
    </div>
  </div>
</div>
<!--资料列表-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">讨论节点 <small><a href="javascript:;" data-toggle="modal" data-target="#allNodeDialog">查看所有</a></small></h3>
  </div>
  <div class="panel-body">
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li role="presentation" id="talk_0"><a href="<?php echo U('/Home/Talk.html/0/');?>">所有</a></li>
  <?php if(is_array($talk_class_display)): $i = 0; $__LIST__ = $talk_class_display;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li role="presentation" id="talk_<?php echo ($vo['id']); ?>"><a href="<?php echo U('/Home/Talk.html/'.$vo['id']);?>"><?php echo ($vo['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<hr>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">创建一个新讨论</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>">
      	<input type="hidden" name="type" value="create">
          <div class="input-group">
            <div class="input-group-addon">讨论主题</div>
            <input class="form-control" type="text" name="talk_title" class="form-control" placeholder="讨论主题" required>
          </div>
        <br />
        <textarea id="content" class="form-control" rows="3" name="talk_content" placeholder="请填写关于这个讨论的内容" required></textarea>
        <br />
          <div class="input-group">
            <div class="input-group-addon">归属节点</div>
          		<select class="form-control selectpicker" name="talk_class" data-live-search="true" required>
              <?php if(is_array($talk_class)): $i = 0; $__LIST__ = $talk_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
     </form>
    </div>
  </div>
</div>

<center><button class="btn btn-primary" data-toggle="modal" data-target="#create">开启新讨论</button></center>

  </div>
</div>
<!--申请新节点-->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">申请新节点</h3>
  </div>
  <div class="panel-body">

<!-- Modal -->
<div class="modal fade" id="registerDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">取消</span></button>
        <h4 class="modal-title" id="myModalLabel">申请一个新节点</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>">
        <input type="hidden" name="type" value="register_node">
          <div class="input-group">
            <div class="input-group-addon">节点名称</div>
            <input class="form-control" type="text" name="node_name" class="form-control" placeholder="节点名称" required>
          </div>
          <br/>
          <div class="input-group">
            <div class="input-group-addon">父节点（可不选）</div>
              <select class="form-control show-tick selectpicker" name="father" data-live-search="true">
              <option value="-1">无父节点</option>
              <?php if(is_array($talk_class)): $i = 0; $__LIST__ = $talk_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">提交</button>
      </div>
     </form>
    </div>
  </div>
</div>

<center><button class="btn btn-primary" data-toggle="modal" data-target="#registerDialog">填写申请</button></center>

  </div>
</div>
<!--/资料列表-->

	</div><!--col-md-3-->
</div><!--row-->
</div><!--container-->

<script type="text/javascript">
  document.getElementById("talk").className="active";
  document.getElementById("talk_<?php echo ($talk_mode); ?>").className="active";
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