
<?php
	include "../connect.php";
	?><ul><?php
	$sql = "select * from mdf order by `id` desc";
	$query = mysql_query($sql);	
	while($result=mysql_fetch_array($query))
	{
		if ($result['checked']){
			echo "<li style=\"margin:5px;\">";
		}else{
			echo "<li style=\"margin:5px;text-decoration:line-through;\">";
		}
		echo "幸福是 ".$result['text']."&nbsp;by&nbsp;".substr($result['person'],0,3);
		//echo $result['text']."&nbsp;by&nbsp;".$result['person'];
		echo "&nbsp;".substr($result['time'],5,2)."月".substr($result['time'],8,2)."日".substr($result['time'],11,2)."点";
		//date_default_timezone_set(PRC);
		//echo "&nbsp;".date("m-d h:i",$result['time']);
		//echo "&nbsp;".date("m-d h:i",$result['time']);
		echo "</li>";
		
	}
?></ul>
<p>If you want to add yours,check <a href="happyAdd.php">here</a></p>