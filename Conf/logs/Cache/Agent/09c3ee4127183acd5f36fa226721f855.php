<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="tpl/Agent/Common/style/style.css" type="text/css" rel="stylesheet">
<title><?php echo C('site_name');?>代理商后台登录</title>
<script src="tpl/Agent/Common/js/mootools1.3.js"></script>
<script src="tpl/Agent/Common/js/mootools-more.js"></script>
<script src="tpl/Agent/Common/js/manage.js"></script>
<script src="tpl/Agent/Common/js/user.js"></script>
</head>
<body id="body" class="">
<style>
.in{height:22px;width:90%}
</style>
<div class="logintop"></div>
<div class="loginmiddle">


<form method="POST" action="?g=Agent&m=Login&a=index" id="autoForm" onsubmit="return checkform();" action="">账号：<input class="colorblur" type="text" style="width:260px;height:18px;" name="email" id="email" value="<?php if (isset($_GET['user'])){echo htmlspecialchars($_REQUEST['user'],ENT_COMPAT ,'utf-8');}?>"></input><br>密码：<input class="colorblur" type="password" style="width:260px;height:18px;" name="password" id="password"></input><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style="cursor:pointer" value="&nbsp;登录" class="loginButton" name="dosubmit" id="dosubmit" type="submit"></input></form></div>
<div class="loginbottom"></div>
<script>
var changeVC=function(){
	//$('vcImg').setProperty('src',"../script.php?oper=checkCode&width=70&height=25&codeNum=4&backGround=&fontColor=&"+Math.random());
}
function checkform(){
		if($('email').value.trim()==''){
			alert('账号不正确');
			return false;
		}else if($('password').value.trim()==''){
			alert('请输入密码');
			return false;
		}
		return true;
}
</script>
<script language="JavaScript">
if (window.top != self){
	window.top.location = self.location;
}
</script>
</body></html>