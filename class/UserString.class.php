<?php
/**
 * 记录了各种各样的登陆字符串
 * @author asus
 *
 */
final class UserString {
	const SQLTableName="userMS_infor";
	const  SQLSreucture="userMS_structure";

	/** 特殊字段，用于密码加密*/
	const ALL_DEAL='LINYANGHUIIUHGNAYNIY';

	//数据库结构库键名
	/** 键名*/
	const SREUCTURE_NAME="NAME";
	/** 类型*/
	const SREUCTURE_TYPE="TYPE";
	/** 检验的正则表达式*/
	const SREUCTURE_CHECKING="CHECKING";
	/** 键名的中文名称*/
	const SREUCTURE_KEY_NAME="KEY_NAME";
	/** 键的描述*/
	const SREUCTURE_TYPE_INFOR="TYPE_INFOR";
	
	//用户动作命令
	/** 用户命令*/
	const USER_ACTION='USER_ACTION';
	/** 用户是否登录*/
	const USER_LOGINED='USER_LOGINED';
	/** 用户的信息*/
	const USER_INFO='USER_INFO';
	/** 用户登录操作*/
	const USER_LOGIN='USER_LOGIN';
	
	//登陆相关字符串
	/** 登陆成功*/
	const LOGIN_SUCCESSFUL='LOGIN_SUCCESSFUL';
	/** 错误的用户名*/
	const LOGIN_WRONG_USERNAME='LOGIN_WRONG_USERNAME';
	/** 错误的用户密码*/
	const LOGIN_WRONG_PASSWORD='LOGIN_WRONG_PASSWORD';
	/** 其他错误类型*/
	const LOGIN_WRONG_OTHER='LOGIN_WRONG_OTHER';
	
	//注册相关字符串
	/** 登陆成功*/
	const REGISTER_SUCCESSFUL='REGISTER_SUCCESSFUL';
	/** 注册时用户名、密码等关键信息不完整或者有错误*/
	const REGISTER_WRONG='REGISTER_WRONG';
	/** 用户密码两次输入不一致*/
	const REGISTER_WRONG_PASSWORD='REGISTER_WRONG_PASSWORD';
	/** 非致命错误：注册时信息不完整或者有错误*/
	const REGISTER_INFOR_MISSED='REGISTER_INFOR_MISSED';
	/** 其他错误类型*/
	const REGISTER_WRONG_OTHER='REGISTER_WRONG_OTHER';
	
	//更新信息
	/** 更新信息成功 */
	const UPDATED_SUCCESSFUL='UPDATED_SUCCESSFUL';
	/** 信息更新失败 */
	const UPDATED_WRONG='UPDATED_WRONG';

	//用户的属性
	/** 邮箱 */
	const USERINFO_EMAIL='EMAIL';
	/** 电话号码 */
	const USERINFO_MOBILE='MOBILE';		
	/** 普通用户名 */
	const USERINFO_USERNAME='USERNAME';
	/** 用户密码 */
	const USERINFO_PASSWORD='PASSWORD';
	/** 用户ID */
	const USERINFO_ID='ID';
	/** 是否符合要求 */
	const USERINFO_UPDATED='UPDATED';
}

?>