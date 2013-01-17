<div id="sedArticle">
<ul>
<?php		
	$sql="SELECT * FROM `sedarticle` order by time desc limit 0 , 30";
	$result = mysqlWork::SQLSelectData($sql);
	while($row=mysql_fetch_array($result)){
		$articleID=$row['ID'];
		$title=$row['title'];
		$userID=$row['userID'];
		$user=$userMS->queryByID($userID);
		$userPet=$user->USERNAME;
		$time=date("n.d A g:i l",$row['time']);
		$classID=$row['classID'];
		$text=$row['text'];
		echo <<<MYSTRING
			<li>
			<div class="artSummary">
				<h3 class="title"><a href="article.php?articleID={$articleID}">{$title}</a></h3>
				<ul class="information">
					<li class="time">{$time}</li>
					<li class="author"><a href = "article.php?userID={$userID}">{$userPet}</a></li>
					<li class="time"><a href = "article.php?classID={$classID}">{$classID}</a></li>
					<li class="comment"><a href = "#">评论</a></li>
				</ul>
				<a href="#" class="more" style="display:none;"><span>阅读全文</span></a>
			</div>
			</li>
MYSTRING;
	}
?>
</ul>
</div>