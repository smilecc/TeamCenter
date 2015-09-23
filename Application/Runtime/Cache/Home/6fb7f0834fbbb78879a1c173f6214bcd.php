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
	
<title>设置中心 - <?php echo C('SITE_TITLE');?></title>
<style type="text/css">
.affix {
    width: 263px;
  }
</style>
<!--
<link href="/Public/css/settings.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/settings_jcrop.css" rel="stylesheet" type="text/css" />
<script src="/Public/js/settings_jquery.uploadify.min.js" type="text/javascript"></script>
<script src="/Public/js/settings_jcrop.js" type="text/javascript"></script>
<script type="text/javascript">
        $(function() {
          $("#user-pic").uploadify({
            'swf' : '/Public/js/settings_uploadify.swf',
            'uploader' : '/index.php/home/user/settings.html',
            'width' : '200',
            'height' : '200',
            'buttonText' : '上传头像',
            'fileTypeExts' : '*.jpg;',
            'fileObjName' : 'filedata',
            'debug' : false,
            'onUploadSuccess' : function(file,data,respone){ //文件上传成功后触发事件
              var data = $.parseJSON(data); //解析json字符串
              if(data['status'] != 1){ //表明上传成功
                return false;
              }
              var imgurl = data['src']; //图片地址
              var preview = $('.upload-area').children('#preview-hidden');
              preview.show().removeClass('hidden');
              //两个预览窗口赋值
              $('.crop').children('img').attr('src',imgurl + '?random='+Math.random());
              //隐藏表单赋值
              $('#img_src').val(imgurl);
              //绑定需要裁切的图片 即给隐藏div添加图片
              var img = $('<img />');
              preview.append(img);
              preview.children('img').attr('src',imgurl+'?random='+Math.random());
              var crop_img = preview.children('img');
                    crop_img.attr('id', "cropbox").show();
                    var img = new Image();
                    img.src = imgurl + '?random=' + Math.random();
                    //根据图片大小居中
                    img.onload = function() {
                        var img_height = 0;
                        var img_width = 0;
                        var real_height = img.height;
                        var real_width = img.width;
                        if (real_height > real_width && real_height > 200) {
                            var persent = real_height / 200;
                            real_height = 200;
                            real_width = real_width / persent;
                        } else if (real_width > real_height && real_width > 200) {
                            var persent = real_width / 200;
                            real_width = 200;
                            real_height = real_height / persent;
                        }
                        if (real_height < 200) {
                            img_height = (200 - real_height) / 2;
                        }
                        if (real_width < 200) {
                            img_width = (200 - real_width) / 2;
                        }
                        preview.css({width: (200 - img_width) + 'px', height: (200 - img_height) + 'px'}); //将样式给予隐藏div
                        preview.css({paddingTop: img_height + 'px', paddingLeft: img_width + 'px'});
                    }
                    
                     $('#cropbox').Jcrop({
                        bgColor: '#333', //选区背景色
                        bgFade: true, //选区背景渐显
                        fadeTime: 1000, //背景渐显时间
                        allowSelect: false, //是否可以选区，
                        allowResize: true, //是否可以调整选区大小
                        aspectRatio: 1, //约束比例 控制等比例裁图
                        minSize: [120, 120],
                        boxWidth: 200,
                        boxHeight: 200,
                        onChange: showPreview,  //选框改变时的事件
                        onSelect: showPreview,  //选框选定时的事件
                        setSelect: [0, 0, 200, 200], //创建选框 0,0选区所在位置！200选区的大小
                    });
                    
            }
          });
          
          //提交裁剪好的图片
            var CutJson = {};
          //预览图
            function showPreview(coords) {
                var img_width = $('#cropbox').width();
                var img_height = $('#cropbox').height();
                //根据包裹的容器宽高,设置被除数
                var rx = 100 / coords.w;
                var ry = 100 / coords.h;
                $('#crop-preview-100').css({
                    width: Math.round(rx * img_width) + 'px',
                    height: Math.round(ry * img_height) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
                rx = 60 / coords.w;
                ry = 60 / coords.h;
                $('#crop-preview-60').css({
                    width: Math.round(rx * img_width) + 'px',
                    height: Math.round(ry * img_height) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
                var imgurl = $('#img_src').val();
                CutJson = {
                    'path': imgurl,
                    'x': Math.floor(coords.x),
                    'y': Math.floor(coords.y),
                    'w': Math.floor(coords.w),
                    'h': Math.floor(coords.h)
                };
            }
          
          //保存头像
            $('#save-pic').click(function() {
                if ($('#preview-hidden').html() == '') {
                    alert('请先上传图片！');
                } else {
                  var resdata;
                    $.ajax({
                      type:'POST',
                        url: "/index.php/home/user/settings.html/?action=jcrop",
                        data: {'crop': CutJson},
                        success: function(result) {
                            window.location.reload();

                          
                        }
                    });
                }
            });
          
            //重新上传
            var i = 0;
            $('#reupload-img').click(function() {
                $('#preview-hidden').find('*').remove();
                $('#preview-hidden').hide().addClass('hidden').css({'padding-top': 0, 'padding-left': 0});
            });
        
        });
</script>-->

<div class="container">
<div class="page-header">
  <h1>设置中心 <small><?php echo ($user_info['username']); ?></small></h1>
</div>

  
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title"><span class="glyphicon glyphicon-wrench"></span> 个人设置</h3>
  </div>
  <div class="panel-body">

<ul class="nav nav-pills">
  <li class="active"><a href="#ziliao" data-toggle="tab">个人资料</a></li>
  <li><a href="#safe" data-toggle="tab">安全中心</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active in fade" id="ziliao"><br />
<blockquote>
  <p>这里可以修改你的相关资料。</p>
</blockquote>

<form class="form-horizontal" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="post" role="form">
<input type="hidden" name="type" value="1"><!--修改的类型-->
  <div class="form-group">
    <label class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo ($user_info['email']); ?></p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">昵称</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo ($user_info['username']); ?></p>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">个人介绍</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="content" placeholder="自我介绍一下吧( • ̀ω•́ )✧..." value="<?php echo ($user_info['content']); ?>" style="width:500px;">
    </div>
  </div>
  <hr>
  
    <div class="form-group">
    <label class="col-sm-2 control-label">性别</label>
    <div class="col-sm-10">

<?php if($user_info['sex']): ?><div class="radio">
  <label>
    <input type="radio" name="sex" id="optionsRadios1" value="man" checked>
    男
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="sex" id="optionsRadios2" value="woman">
    女
  </label>
</div>
<?php else: ?>
<div class="radio">
  <label>
    <input type="radio" name="sex" id="optionsRadios1" value="man">
    男
  </label>
</div>
<div class="radio">
  <label>
    <input type="radio" name="sex" id="optionsRadios2" value="woman" checked>
    女
  </label>
</div><?php endif; ?>

    
    </div>
  </div>
  
    <div class="form-group">
    <label class="col-sm-2 control-label">生日</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="birthday" value="<?php echo ($user_info['birthday']); ?>" style="width:250px;">
    </div>
  </div>
<hr>
      <center><button type="submit" class="btn btn-primary" style="width:130px;">提交</button></center>
</form>

</div><!--资料-->
<div class="tab-pane fade" id="safe"><br />
  <blockquote>
  <p>这里可以修改你的密码及密保问题等。</p>
</blockquote>
<form class="form-horizontal" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="post" role="form">
<input type="hidden" name="type" value="2"><!--修改的类型-->
  <div class="form-group">
    <label class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?php echo ($user_info['email']); ?></p>
    </div>
  </div>

<div class="form-group">
    <label class="col-sm-2 control-label">原密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="oldpw" style="width:30%;" required>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">新密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="请设置长度为6-16位的密码" name="newpw" style="width:30%;">
    </div>
</div>
<hr>
<!--
<div class="form-group">
    <label class="col-sm-2 control-label">安全问题</label>
    <div class="col-sm-10">
      <select class="form-control" style="width:50%;" name="pwquestion">
    <option value="0">无安全问题</option>
    <option value="1">我小学所在的学校是哪一所？</option>
    <option value="2">我的出生地是哪儿？</option>
    <option value="3">我的妈妈叫什么名字？</option>
    <option value="4">我初恋的名字叫什么？</option>
    <option value="5">我的本命动漫是哪一部？</option>
</select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">安全问题答案</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="pwanswer" style="width:30%;">
    </div>
</div>
<hr>-->
      <center><button type="submit" class="btn btn-primary" style="width:130px;">提交</button></center>
</form>

  </div><!--安全-->
</div>
  </div>
</div>
  </div>
</div>

	<!-- /主体 -->

	<!-- 底部 -->
	<div class="container">
<hr>
<footer>
&copy; Company 2014 All rights reserved - Design By <a href="http://cuican.name">璨</a>
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