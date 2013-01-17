<?php
	session_start();
	$link = mysql_connect("localhost","root","86458043") or die("连接失败：".mysql_error); //数据库连接
	$database = "xinke3";  //数据库名字
	$ooo = mysql_select_db($database,$link);
	//if($ooo)	echo "连接数据库成功<br>";
	mysql_query("SET character_set_connection='utf8', character_set_results='utf8', character_set_client='utf8'"); 
	
?>