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
button,p,h1,h2,h3,h4,h5,h6,a,td {
font-family:Microsoft YaHei;
}
</style>
</head>
<body>
	<!-- 头部 -->
	
<title>注册 - 五次元</title>
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
}</style>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
<body>
<div class="container">
<div class="page-header">
  <h1 style="font-family:Microsoft YaHei">五次元 <small>注册 register</small></h1>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
        <form class="form-signin" role="form" action="/index.php/Home/User/register.html" method="post" id="reform">
		<?php ?>

        <input type="text" id="email" name="email" class="form-control" placeholder="Email地址" required>
        <input type="text" id="name" name="username" class="form-control" placeholder="昵称（1-8个字符）" required>
        <input type="password" id="password" name="password" class="form-control" placeholder="密码（6-16个字符）" required>
		<input type="password" id="pwag" name="pwag" class="form-control" placeholder="重复密码" required>

		<div class="row">
		<div class="col-md-5"><input name="verify" type="text" class="form-control" placeholder="验证码" id="verify" maxlength="3" /></div>
		<div class="col-md-3"><img src="<?php echo U("verify");;?>" title="看不清，点击换一张" align="absmiddle" onClick="this.src=this.src+'?'+Math.random()"></div>
		</div>

          <br />
        <button class="btn btn-lg btn-primary btn-block" id="sub" type="submit">注册</button>
      </form>

</div>
<!--右侧-->
<div class="col-md-6">
<br />
>已有账号？点击<a href="<?php echo U("Home/User/login");;?>">登录</a><br /><br />
>点击<a href="/">返回主页</a>
</div>
<!--/右侧-->
</div>
</div>
</body>

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

	<!-- /底部 -->
</body>
</html>