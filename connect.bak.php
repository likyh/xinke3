<?php //one task;
	//session_start();
	$link = mysql_connect("localhost","likyh","dd88185039") or die("连接失败：".mysql_error); //数据库连接
	$database = "likyh_xinke3";  //数据库名字
	$ooo = mysql_select_db($database,$link);
	/*if($ooo)
	{
		echo "连接数据库成功";  
	}*/
	mysql_query("set names 'utf8'");
	mysql_query("SET CHARACTER_SET_CLIENT=utf8");
	mysql_query("SET CHARACTER_SET_RESULTS=utf8");
	
	function htmtocode($content) {
		$content = str_replace("\"", "&quot;", str_replace("'", "\"", str_replace(">", "&gt;", str_replace("<", "&lt;", $content))));
		return $content;
	}
	
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
	
	function GBsubstr($string, $start, $length) {
		if(strlen($string)>$length){
		 $str=null;
		 $len=$start+$length;
		 for($i=$start;$i<$len;$i++){
		if(ord(substr($string,$i,1))>0xa0){
		 $str.=substr($string,$i,2); //如果使用的编码是UTF8的话处为3，且下面再加一个$i++;
		 $i++;
		}else{
		 $str.=substr($string,$i,1);
		 }
		}
	   return $str.'...';
		}else{
	   return $string;
	   }
	}
?>