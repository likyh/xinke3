<?php
	/**
	 * 测试用户登录
	 * @param string $u 用户名
	 * @param string $p 密码
	 */
	function testLogin($u,$p){
		$userms=new UserMS();
		echo "username:$u\npassword:$p\n";
		echo "loginResult:",$userms->login($u, $p);
		if(isset($_SESSION)){
			echo "\nSession:";
			print_r($_SESSION);
		}else{
			echo "\nNo Session\n";
		}
		echo "***********************\n";
	}
	require_once("UserMS.class.php");
	testLogin('likyh','as');
	testLogin('likyh1','as');
	testLogin('likyh','a');
	testLogin('likyh','a"');
	testLogin(' likyh','a');
	testLogin('\/likyh','as"');
	testLogin('likyh"','a');
	testLogin('likyh','a');
?>