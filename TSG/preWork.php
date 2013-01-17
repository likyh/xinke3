<?php
	include "../function/baseWork.php";
	// 计算相关的一些必要信息
	
	if (isMobile()){
		//手机
		$_SESSION['mobile']=true;
		$_SESSION['TopBG']="images/thanksTopM.png";
	}else{
		//电脑
		$_SESSION['mobile']=false;
		$_SESSION['TopBG']="images/thanksTop.png";
	}
	
	/*//这句话是调试用的。
	$_SESSION['mobile']=true;
	$_SESSION['TopBG']="images/thanksTopM.png";*/

?>