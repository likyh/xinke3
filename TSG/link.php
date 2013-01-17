<?php 
if ($_SESSION['mobile']){
	echo '<link href="TSGM.css" rel="stylesheet" type="text/css" />';
}else{
	echo '<link href="TSGC.css" rel="stylesheet" type="text/css" />';
}
?>