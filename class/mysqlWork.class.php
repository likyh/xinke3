<?php
/*$link = mysql_connect("localhost","likyh","dd88185039") or die("连接失败：".mysql_error); //数据库连接
$database = "likyh_xinke3";  //数据库名字*/
$link = mysql_connect("localhost","root","1234") or die("连接失败：".mysql_error); //数据库连接
$database = "xinke3";  //数据库名字
$ooo = mysql_select_db($database,$link);
//if($ooo){echo "连接数据库成功";}
mysql_query("set names 'utf8'");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
/**
 * 此类是简化SQL查询用的
 * @author linyh
*/
class mysqlWork{
	
	/**
	 * sql资源转换成一个数组
	 * @param res $res 一个sql查询的结果集
	 * @return array 转换后的结果
	 */
	private static  function sqlResToArray($res){
		$resultArray=array();
		$i=0;
		do{
			$temp=mysql_fetch_assoc($res);
			$resultArray[$i++]=$temp;
		}while($temp);
		return $resultArray;
	}
	/**
	 * sql资源转换成一个数组
	 * @param res $res 一个sql查询的结果集
	 * @param string $primaryKey 主键
	 * @return array 转换后的关联数组
	 */
	private static  function sqlResToAssArray($res,$primaryKey){
		$resultArray=array();
		$i=0;
		while($temp=mysql_fetch_assoc($res)){
			$key=$temp[$primaryKey]?$temp[$primaryKey]:$i++;
			$resultArray[$key]=$temp;
		}
		return $resultArray;
	}
	
	/**
	 * 查询并返回查询结果
	 * @param string $sql 要查询的sql语句
	 * @param string $primaryKey 生成关联数组一次作为索引，为空则生成数值数组
	 * @return array 返回查询结果的数组
	 */
	public static function SQLSelectData($sql,$primaryKey=""){
		$result=mysql_query($sql);//执行SQL语句
		if($result && mysql_affected_rows() > 0){//如果数据存在
			$row = $result;//获得执行结果
			if(!$primaryKey){
				$rowArray=self::sqlResToArray($row);
			}else{
				$rowArray=self::sqlResToAssArray($row,$primaryKey);
			}
			return $rowArray;
		}else{
			return NULL;//返回查询不到结果
		}
	}
	
	/**
	 * 查询是否存在
	 * @param string $sql
	 * @return bool 是否存在
	 */
	public static function SQLSelectExist($sql){
		$result=mysql_query($sql);//执行SQL语句
		if($result && mysql_num_rows($result)> 0){//如果数据存在
			return true;//返回数据存在
		}else{
			return false;//返回数据不存在
		}
	}
	
	/**
	 * 数据库插入\更新数据
	 * @param string $sql
	 * @return int 返回结果影响的条数，如果执行失败则返回-1
	 */
	public static function SQLAffect($sql){
		$result=mysql_query($sql);//执行SQL语句
		if($result && mysql_affected_rows()>= 0){
			return mysql_affected_rows();
		}else{
			return -1;
		}
	}
}
?>