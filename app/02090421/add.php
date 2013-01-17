<?php
	
	//获得ip信息
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
		?>
<?php
require_once "MyList.class.php";
$mylist=new MyList();
?>
<?php
require "div/head.div.php";
?>
<body>
<div id="container">
	<?php require "div/mainTitle.div.php";?>
	<?php require "div/banner.div.php";?>
	<?php require "div/navigation.div.php";?>
	<div id="content">
		<div id="labels">
			<?php require "div/loginLabel.div.php";?>
			<?php require "div/tinyListLabel.div.php";?>
			<?php require "div/giftLabel.div.php";?>
		</div>
		<!-- end of left panel -->
		
		<div id="articles">
			<?php require "div/welcome.add.div.php";?>
			<?php require "div/input.add.div.php";?>
		</div>
		<!-- end of content --> 
	</div>
	<div id="contentBottom"> </div>
	<?php require "div/copyright.div.php";?>
	<!-- end of container --> 
</div>
</body>
</html>
<?php
	}
?>