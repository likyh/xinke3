<?php
	/**
	 * 测试用户名类型判断
	 * @param string $u 用户名
	 */
	require_once("UserModel.class.php");
	require_once("User.class.php");
	
	
	echo "*************test function UserModel::userType*****************\n";
	function testUserType($u){
		echo $u,' => ',UserModel::userType($u),"\n";
	}
	testUserType('li');
	testUserType('liky');
	testUserType('likyh');
	testUserType('likyhgwknchke');
	testUserType('lik2345135');
	testUserType('l214525');
	testUserType('lb--greu');
	testUserType('lb_greu');
	testUserType('lb.-greu');
	testUserType('180');
	testUserType('1805214');
	testUserType('180521414');
	testUserType('18052141484');
	testUserType('linyanghui2009@qq.com');
	testUserType('likyh@qq.com');
	testUserType('lin.yanghui2009@qq.com');
	testUserType('lin-yanghui2009@qq.com');
	testUserType('lin.yang.hui.2009@qq.com');
	testUserType('lin.yang.hui.2009.@qq.com');
	testUserType('lin-yang-hui2009@qq.com');
	testUserType('lin-yang-hui-2009-@qq.com');
	testUserType('lin_yanghui2009@qq.com');
	testUserType('lin_yang_hui_2009@qq.com');
	testUserType('lin_yang_hui_2009_@qq.com');
	testUserType('li"');
	testUserType('liky"');
	testUserType('likyh\'');
	testUserType('likyhgwknchke"');
	testUserType('lik2345135;');
	testUserType('l214525,');
	testUserType('18052141484-');
	testUserType("linyanghui2009@qq.com\nadsf");
	testUserType("lin_yang_hui_2009_@qq.com\n'''");
	
	
	echo "*************test function UserModel::querySQLSreucture*****************\n";
	print_r(UserModel::querySQLSreucture());
	
	echo "*************test function UserModel::updateUser*****************\n";
	$userInfo=array('USERNAME'=>'likyh','MOBILE'=>'18052141484','MOBILE'=>'18052141484','EMAIL'=>'likyh@qq.com','DNAME'=>'林阳辉',);
	print_r(UserModel::updateUser(1,new User($userInfo)));
?>



