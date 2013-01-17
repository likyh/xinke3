<?php

/**
 * 获得ip信息
 * @return string 返回IP信息
 */
function GetIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(!empty($_SERVER["REMOTE_ADDR"])){
		$cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
		$cip = "无法获取！";
	}
	return $cip;
}

function error(string $errorInfor){
	header("Location: ./error.php?errorInfor={$errorInfor}");
	exit;
}

if (isset($_GET['action'])&&$_GET['action']=="add"){
	
	define("webRoot","../..");//文档根目录
	require_once webRoot."/class/mysqlWork.class.php";
	require_once webRoot."/class/TextFilter.class.php";
	
	$name=TextFilter::chineseTextReplace($_POST['name']);
	if(!preg_match('/^[\x{4e00}-\x{9fa5}]{2,}(·[\x{4e00}-\x{9fa5}]{1,})*$/u',$name)){
		header("Location: ./error.php");
		exit;
	}
	$title=TextFilter::chineseTextReplace($_POST['title']);
	if(!preg_match('/^.{0,15}$/u',$title)){
		header("Location: ./error.php");
		exit;
	}
	$text=TextFilter::chineseTextReplace($_POST['text']);
	if(!preg_match('/^.{40,}$/u',$text)){
		header("Location: ./error.php");
		exit;
	}
	//echo $text;
	$time=time();
	$ip=GetIP();
	$sql = "INSERT INTO `02090421_article` (`person`,`title`,`text`,`time`,`ip`,`checked`) VALUES ('{$name}','{$title}','{$text}','{$time}','{$ip}',1);";
	$query = MysqlWork::SQLAffect($sql);
	header("Location: ./");
	exit;
}else{
	header("Location: ./error.php");
	exit;
}

?>