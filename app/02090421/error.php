<?php 
define("webRoot","../..");//文档根目录
require_once webRoot."/class/TextFilter.class.php";
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>出错</title>
</head>

<body>
<?php
if (isset($_GET['errorInfor'])){
	echo "错误信息：".TextFilter::showTextReplace($_GET['errorInfor']);
}
?>
<br/>
对不起，您输入了无效的信息。
注意名字不要乱打，可能是标题太长（标题最长15字）
也可能是文章内容太短（至少要40字）
<a href="javascript://history.back();">返回</a>
</body>
</html>