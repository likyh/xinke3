<?php
require_once "mysqlWork.class.php";//包含SQL处理类
require_once "User.class.php";//包含User数据类
require_once "UserString.class.php";//包含User配置数据类
/**
 * 这是一个与数据层直接交流的信息模型类 属于MVC模型中的model
 * 用户可以使用邮箱，普通用户名，手机号码登陆；
 * 普通用户名要以字母开头，字母、数字、下划线组成。
 * 密码记录方式md5(a.md5(a.p.p.a).md5(a.p.p.a).a);a是ALL_DEAL,p是password
 * @author linyh
 *
 */
class UserModel {
	/**
	 * 将一段字符串进行加密，需要将一个字符串加密两次才能得到存入数组的字符串
	 * @param string $password
	 * @return string 加密的字符串
	 */
	public static function myEncryption($password){
		$password=md5(UserString::ALL_DEAL.$password.$password.UserString::ALL_DEAL);
		return $password;
	}
	
	/**
	 * 删除原有的登录数据，包括seesion,cookie
	 */
	private static function recordDestory(){
		if(isset($_SESSION[UserString::USER_LOGINED])) unset($_SESSION[UserString::USER_LOGINED]);
		if(isset($_SESSION[UserString::USER_INFO])) unset($_SESSION[UserString::USER_INFO]);
		setcookie(UserString::USERINFO_USERNAME,"",time()-24*60*60);
		setcookie(UserString::USERINFO_PASSWORD,"",time()-24*60*60);
	}
	
	/**
	 * 用于在session记录用户已登录以及登陆的用户的信息
	 */
	private static function recordSession(User $userInfo){
		$_SESSION[UserString::USER_LOGINED]=true;
		$_SESSION[UserString::USER_INFO]=$userInfo;
	}
	
	/**
	 * 用于在cookie记录用户已登录以及登陆的用户的信息
	 * @param string $username 普通的用户名
	 * @param string $passwordTemp 用户初次加密过的密码
	 */
	private static function recordCookie($username,$passwordTemp){
		setcookie(UserString::USERINFO_USERNAME,$username,time()+7*24*60*60);
		setcookie(UserString::USERINFO_PASSWORD,$passwordTemp,time()+7*24*60*60);
	}
	
	/**
	 * 判断用户名类型
	 * @param string $username
	 * @return string
	 */
	public static function userType($username){
		if(preg_match('/^[a-zA-Z]\w{4,}$/',$username)){//普通用户名
			return UserString::USERINFO_USERNAME;
		}
		if(preg_match('/^\d{11}$/',$username)){//电话号码
			return UserString::USERINFO_MOBILE;
		}
		if(preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/',$username)){//邮箱号码
			return UserString::USERINFO_EMAIL;
		}
		return NULL;
	}
	
	/**
	 * 此函数查询数据表的信息
	 * @param string $key 搜索列的关键字
	 * @return Array 返回一个记录着数据库字段和信息的关联数组
	 */
	public static function querySQLSreucture(string $key=""){
		$keyCheck=array("PRIMARY"=>" where `type`='PRIMARY' or `type`='PASSWORD'",
				"enChanged"=>" where `type`!='PASSWORD'");
		if(isset($keyCheck[$key])){
			$map=$keyCheck[$key];
		}else{
			$map="";
		}
		$sql="select * from `".UserString::SQLSreucture.$map;
		$row = mysqlWork::SQLSelectData($sql,"name");
		if(isset($row)){//如果数据存在
			return $row;
		}else{
			return array();
		}
	}
	
	/**
	 * 此函数通过id号码来查询某一个用户的信息
	 * @param int $id 用户id号码
	 * @return User 返回用户信息
	 */
	public static function queryByID($id){
		$id=(int)($id);
		$sql="select * from `".UserString::SQLTableName."` where `".USERINFO_ID."` = {$id}";
		$row = mysqlWork::SQLSelectData($sql);
		if(isset($row[0])){//如果数据存在
			return new User($row[0]);
		}else{
			return new User($row[0]);
		}
	}
	
	/**
	 * 此函数通过username来查询某一个用户的信息
	 * @param string $username 用户名
	 * @return User 返回用户信息
	 */
	public static function queryByUsername($username){
		$sql="select * from `".UserString::SQLTableName."` where `".UserString::USERINFO_USERNAME."` = '{$username}'";
		$row = mysqlWork::SQLSelectData($sql);
		if(isset($row[0])){//如果数据存在
			return new User($row[0]);
		}else{
			return new User($row[0]);
		}
	}
	
	/**
	 * 此函数通过username来查询某一个用户是否存在
	 * @param string $username 用户名
	 * @return bool 返回是否存在
	 */
	public static function queryByUsernameI($username){
		$sql="select * from `".UserString::SQLTableName."` where `".UserString::USERINFO_USERNAME."` = '{$username}'";
		return $exist = mysqlWork::SQLSelectExist($sql);
	}
	
	/**
	 * 此函数查询数据库，并且在登陆成功以后记录此用户的信息
	 * @param string $username 用户名
	 * @param string $password 用户未加密过的密码
	 * @param User $userInfo 引用变量 记录用户信息的变量
	 * @return string 登录结果
	 */
	public static function queryByPassword($username,$password,User &$userInfo){
		self::recordDestory();//一旦登陆，就删除原来的登录信息
		
		//判断有没有这个用户名
		if (!self::queryByUsernameI($username)){
			//不存在，返回登陆失败信息：没有这个用户名
			$returnResult=UserString::LOGIN_WRONG_USERNAME;
			return $returnResult;
		}
		
		//对密码进行初次以及二次加密
		$passwordTemp=self::myEncryption($password);
		$password=self::myEncryption($passwordTemp);
		//构造查询字符串，查询获得用户信息
		$sql="select * from `".UserString::SQLTableName."` where `".UserString::USERINFO_USERNAME."` = '{$username}' and `".UserString::USERINFO_PASSWORD."` = '{$password}' ";

		$row=mysqlWork::SQLSelectData($sql);
		if(isset($row[0])){
			//如果登陆密码正确
			$userInfo=new User($row[0]);//初始化用户信息
			self::recordSession($userInfo);//记录用户已经登陆
			self::recordCookie($username,$passwordTemp);//记录用户已经登陆
			$returnResult=UserString::LOGIN_SUCCESSFUL;//返回登陆成功
			return $returnResult;
		}else{
			$returnResult=UserString::LOGIN_WRONG_PASSWORD;
			return $returnResult;//返回登录失败
		}
	}
	
	public static function updatePassword($password){
		
	}
	
	/**
	 * 这个函数用来更新用户的信息
	 * @param int $id
	 * @param User $user
	 * @return string
	 */
	public static function updateUser($id,User $user){
		//定义基本的关键字信息
		$k=array('name'=>UserString::SREUCTURE_NAME,'check'=>UserString::SREUCTURE_CHECKING,'type'=>UserString::SREUCTURE_TYPE,'keyname'=>UserString::SREUCTURE_KEY_NAME,'infor'=>UserString::SREUCTURE_TYPE_INFOR);

		$id=(int)$id;
		$userSre=self::querySQLSreucture('enChanged');
		$sqlData=array();
		//循环对每一个数据库列获取值
		foreach($userSre as $item){
			if(isset($user->$item[$k('name')])){
				if(isset($item[$k('check')])){
					if($item[$k('check')]!=""){
						if(!preg_match($item[$k('check')],$user->$item[$k('name')])){
							echo $item[$k('check')],$user->$item[$k('name')];
							return UserString::UPDATED_WRONG;
						}
					}
				}
				$sqlData[$item['name']]=$user->$item['name'];
				
			}else{
				if($item['type']=='UNIQUE'&&$item['type']=='NEEDED'){
					return UserString::UPDATED_WRONG;
				}
			}
		}
		//构造查询语句
		$sql="UPDATE `".UserString::SQLTableName."` SET ";
		foreach($sqlData as $key=>$vaule){
			$sql.="`".$key."`='".$vaule."', ";
		}
		$sql=strrev(substr(strrev($sql),2));
		$sql.=" where `".UserString::USERINFO_ID."`= $id";
		echo $sql;
		return UserString::UPDATED_SUCCESSFUL;
	}

	public static function insertUser($username,$password,$passwordConfirm,$user){
		self::recordDestory();//一旦注册，就删除原来的登录信息
		if(!preg_match('/^[a-zA-Z]\w{4,}$/',$username)){//普通用户名
			return UserMS::REGISTER_WRONG;
		}
		if($password!=$passwordConfirm){//验证密码是否正确
			return UserMS::REGISTER_WRONG_PASSWORD;
		}
		self::querySQLSreucture('PRIMARY');
		$sql="";
		if (mysqlWork::SQLSelectExist($sql)){
			$this->login();
			$returnResult=self::REGISTER_SUCCESSFUL;
		}else{
			$returnResult=self::REGISTER_WRONG_OTHER;
			return $returnResult;
		}
	}
}
?>