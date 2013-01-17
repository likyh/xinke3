<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<?php
	//字符过滤
	function codeCheck($content) {
		$content = str_replace(
			array('"',"'","\\","/","<",">"),
			array("&quot;","&quot;","、","、","&lt;","&gt;"),
			$content);
		return $content;
	}
	echo time()."<br>";
	echo date("Y-n-d A H:i:s I",time())."<br>";
	echo codeCheck('<?php $timestamp=time(); echo $timestamp; ?>')."<br>";
	
	/*$a=array(1421,1234,12412,124214,124214);
	while($b=$a){
		echo $b;
	}*/
	echo date("y-m-d h:m:s");
?>
</body>
</html>