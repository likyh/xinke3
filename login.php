<?php
	session_start();
	set_include_path(get_include_path().PATH_SEPARATOR."d:/AppServ/www/xinke3/");//定义加载默认路径
	include "connect.php";//加载数据库选项，以后这句话移动到mysqlWork类中
	require_once("class/UserMS.class.php");//用户管理系统
	$userMS=new UserMS();//新建一个用户的示例
?>
<?php
if(isset($_POST['submit'])&&$_POST['submit']=="USER_LOGIN"){
	$username=isset($_POST['username'])?$_POST['username']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';
	$loginRusult=$userMS->login($username,$password);
	$login=$loginRusult==userMS::LOGIN_SUCCESSFUL;
	if($login){
		header("Location:index.php");
	}else{
		echo "<script language=\"javascript\">alert('{$loginRusult}');</script>";
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>xinke-3</title>
</head>

<body>
<form action="login.php" method="post" name="loginFrom">
<label for="username">用户名：<input name="username" id="username" type="text"/></label>
<label for="password">密　码：<input name="password" id="password" type="password"/></label>
<input name="submit" id="submit" value="USER_LOGIN" type="submit"/>
</form>
</body>
</html>