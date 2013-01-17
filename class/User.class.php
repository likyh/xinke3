<?php
require_once 'UserString.class.php';
/**
 * 一个记录用户信息的数据类
 * @author linyh
 *
 */
class User{
	/**
	 * 构造函数 用数组构造一个用户信息类
	 * @param Array $userInfo
	 */
	function __construct(array $userInfo=array(UserString::USERINFO_ID=>0,UserString::USERINFO_USERNAME=>"")){
		//print_r($userInfo);
		foreach($userInfo as $key => $value){
			$this->$key=$value;
		}
	}
}
?>