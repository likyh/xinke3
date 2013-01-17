<?php
	session_start();
	//set_include_path(get_include_path().PATH_SEPARATOR."d:/AppServ/www/xinke3/");//定义加载默认路径
	define("webRoot","/xinke3/");//文档根目录
	include "connect.php";//加载数据库选项，以后这句话移动到mysqlWork类中
	include "fundamentalFunction.php";//加载基础函数
	require_once("class/UserMS.class.php");//用户管理系统
	$userMS=new UserMS();//新建一个用户的示例
	
	//自动加载类名
	function __autoload($className){
		$className=str_replace(".","",$className);
		require_once("class/{$className}.class.php");
	}
	
	//$userMS=new UserMS();
	//echo " ".$userMS->check();
	//print_r($userMS);
	//if($userMS->check()!=UserMS::LOGIN_SUCCESSFUL){
	//	header("Location:".webRoot."login.php");
	//}
?>