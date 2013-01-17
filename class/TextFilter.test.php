<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<?php
	require_once("TextFilter.class.php");
	echo TextFilter::pureTextReplace("abcdefghijklmnopqrstuvwxyz\nABCDEFGHIJKLMNOPQRSTUVWXYZ\n'\"\\/<>\n");
	echo TextFilter::showTextReplace("abcdefghijklmnopqrstuvwxyz\nABCDEFGHIJKLMNOPQRSTUVWXYZ\n'\"\\/<>\n");
			
?>
</body>
</html>