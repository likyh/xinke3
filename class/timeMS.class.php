<?php
/**
 * 时间处理的类
 * @author linyh
 *
 */
class timeMS{
	public function dateStr($timeNow= 0){
		if($timeNow==0){$timeNow=time();}
		$timeStr=date("n.d A g:i l",$timeNow);
		return $timeStr;
	}
}
$a=new timeMS();
print_r($a->dateStr());
?>