<?php
	include "../connect.php";
	if ($_GET['submit']!="submit"){
		?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mid Autumn Festival</title>
</head>

<body style="background-color:#FFFFD2;">
<form action="happyAdd.php?submit=submit" method="post" name = "addForm" id="addForm">
	<p>
		<label for="name"class="lsInputLabel" >name(写全名，我们会保护好您的信息):
			<input name="name" id="name" type="text" value="" style="background:none;border:none;border-bottom:inset black 1px;"/>
		</label>
		<br/>
		<label for="text"class="lsInputLabel" >text:幸福是
			<input name="text" id="text" type="text" value=""style="background:none;border:none;border-bottom:inset black 1px;margin:0;padding:0px;width:368px;"/>
		</label>
		<br/>
		<input name="submit" type="submit" value="确定最后句号加好了？提交"/>
	</p>
</form>
</body>
</html>
<?php
	}else{
		$name=htmtocode($_POST['name']);
		if ($name=="佚名"){$name="鬼";}
		$text=htmtocode($_POST['text']);
		//echo $text;
		$time=date("y-m-d h:m:s");
		$ip=GetIP();
		$sql = "INSERT INTO `mdf` (`person`,`text`,`time`,`ip`) VALUES ('{$name}','{$text}','{$time}','{$ip}');";
		//echo $sql;
		$query = mysql_query($sql);
		header("Location: MDF.php");
	}
?>