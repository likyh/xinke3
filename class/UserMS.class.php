<?php
require_once "mysqlWork.class.php";//包含SQL处理类
require_once "User.class.php";//包含User数据类
require_once "UserModel.class.php";//包含User数据相互类
require_once "UserString.class.php";//包含User配置数据类
require_once 'TextFilter.class.php';
/**
 * 这是一个用于管理用户的class，可以控制是否登录，属于MVC模型中的control
 * @author linyh
 *
 */
class UserMS{	
	public $logined=false;//是否已经登录
	public $user;//其他用户属性
	
	
	const ALL_DEAL='LINYANGHUIIUHGNAYNIY';//特殊字段
	
	/**
	 * 检查session cookie以实现自动登录
	*/	
	public function check(){
		///////********这两句话是测试用的
		$this->logined=false;
		$_SESSION[self::USER_LOGINED]=false;
		echo $this->logined;
		
		if($this->logined==true){return true;}//检查是否有登陆的信息
		//如果没有登录信息，则继续检查SESSION和COOKIE
		if(isset($_SESSION[self::USER_LOGINED])&&$_SESSION[self::USER_LOGINED]==true){
			//如果session里有登录记录，则读取出来。
			$this->logined=true;
			//这里建一个User的对象，读取session中的内容
			$this->user=$_SESSION[self::USER_INFO];
			$loginResult=self::LOGIN_SUCCESSFUL;
			
		}else if (isset($_COOKIE[self::USERNAME])
				&&isset($_COOKIE[self::PASSWORD])){
			//登录操作
			$username=TextFilter::pureTextReplace($_COOKIE[self::USERNAME]);
			$password=$_COOKIE[self::PASSWORD];
			$password=md5(self::ALL_DEAL.$password.$password.self::ALL_DEAL);//密码加密
			
			$loginResult=$this->SQLSelectCheck($username,$password);
			if($loginResult==self::LOGIN_SUCCESSFUL){
				$this->logined=true;//记录已登录
				$this->recordSession();//记录用户已经登陆
			}else{
				//无法登陆，删除无效的cookie信息
				$this->recordDestory();
			}
			
		}else{
			$loginResult=self::LOGIN_WRONG_OTHER;
			$this->logined=false;
		}
		return $loginResult;
	}
	
	/**
	 * 用户登录
	 * @param string $username 要登陆的用户的用户名，当然也有可能是邮箱什么的，不过暂时还不行
	 * @param string $password 要登陆的用户的原始密码
	 * @return string 登陆结果以相应的字符串返回
	 */
	public function login($username,$password){
		$username=TextFilter::pureTextReplace($username);//过滤用户名
		
		$password=trim($password);
		
		$loginResult=UserModel::queryByPassword($username, $password, $tempUser=new User());
		if($loginResult==UserString::LOGIN_SUCCESSFUL){
			$this->logined=true;//记录已登录
			$this->user=$tempUser;
		}
		return $loginResult;
	}
	
	//此函数用于实现注册功能，返回注册成功，注册失败
	public function register($username,$password,$passwordConfirm,$user){
		$this->recordDestory();
		if(!preg_match('/^[a-zA-Z]\w{4,}$/',$username)){//普通用户名
			return UserMS::REGISTER_WRONG;
		}
		if($password!=$passwordConfirm){//验证密码是否正确
			return UserMS::REGISTER_WRONG_PASSWORD;
		}
		$sql="insert into {$this->SQLTableName} (`EMAIL`, `MOBILE`, `USERNAME`, `PASSWORD`, `UPDATED`) VALUES ('{$user->EMAIL}', '{$user->MOBILE}', '{$user->USERNAME}', '{$user->PASSWORD}', '{$user->UPDATED}')";
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