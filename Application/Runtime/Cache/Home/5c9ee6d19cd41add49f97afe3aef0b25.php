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
	
	<!-- /头部 -->
	
	<!-- 主体 -->
	

<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
  font-family:Microsoft YaHei;
}
h2 {font-family:Microsoft YaHei;}
.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<div class="container">
<div class="page-header">
  <h1 style="font-family:Microsoft YaHei">社团管理系统 <small>登录 login</small></h1>
</div>
</div>

<div class="container">
<div class="row">

    <title>登录 - 社团管理系统</title>

        <form class="form-signin" role="form" action="/Home/User/login" method="post" id="reform">
        <input type="text" id="email" name="email" class="form-control" placeholder="Email地址" required autofocus>
        <input type="password" id="password" name="password" class="form-control" placeholder="密码" required>

		<div class="row">
		<div class="col-md-5"><input type="text" class="form-control" placeholder="验证码" name="verify" maxlength="4" /></div>
		<div class="col-md-3"><img src="<?php echo U('verify');?>" id="getcode_gg" title="看不清，点击换一张" align="absmiddle" onClick="this.src=this.src+'?'+Math.random()"></div>
		</div>

          <br />
        <button class="btn btn-lg btn-primary btn-block" id="sub" type="submit">登录</button>
      </form>
      </body>


</div>
</div>

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