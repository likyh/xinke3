<?php
	include "../function/baseWork.php";
?>
<?php	
	$articleID=(int)($_GET['articleID']);
	$sql="SELECT * FROM `sedarticle` where `ID`={$articleID} limit 0 , 1";
	$result = mysqlWork::SQLSelectData($sql);
	if($row=mysql_fetch_array($result)){
		$articleID=$row['ID'];
		$title=$row['title'];
		$userID=$row['userID'];
		$user=$userMS->queryByID($userID);
		$userPet=$user->USERNAME;
		$time=date("n.d A g:i l",$row['time']);
		$classID=$row['classID'];
		$text=$row['text'];
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="skin/SED.css" rel="stylesheet" type="text/css" />
<title>Study Every Day Article</title>
</head>

<body>
<div id="container">
	<div id="sedArticleMore">
		<?php include "component/top.div.php"; ?>
		<?php	
		echo <<<MYSTRING
			<h3 class="title"><a href="article.php?articleID={$articleID}">{$title}</a></h3>
			<ul class="information">
				<li class="time">{$time}</li>
				<li class="author"><a href = "article.php?userID={$userID}">{$userPet}</a></li>
				<li class="time"><a href = "article.php?classID={$classID}">{$classID}</a></li>
			</ul>
			<div id="articleText">
				{$text}
			</div>
			<div id="articleText">
				{$text}
			</div>
MYSTRING;
?>
		<?php include "component/copyright.div.php"; ?>
</div>
</div>
</body>
</html>