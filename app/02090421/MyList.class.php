<?php
define("webRoot","../..");//文档根目录
require_once webRoot."/class/mysqlWork.class.php";
class MyList{
	private function selectList($num=-1){
		$num=(int)$num;
		if($num==-1){
			$sql = "select * from `02090421_article` where checked=1 order by `time` desc";
		}else{
			$sql = "select * from `02090421_article` where checked=1 order by `time` desc limit 0,$num";
		}
		$query = mysqlWork::SQLSelectData($sql);	
		return $query;
	}
	private function lList($num=-1,$iTitle=true,$iAuthor=true,$iText=true,$iTime=true,$iMore=true){
		$query=$this->selectList($num);
		$resultStr="";
		$resultStr.="<dl>";
		$i=0;
		foreach($query as $item){
			$i++;
			if ($item['checked']==0) continue;
			$time=date("m月d日 H:i:s",$item['time']);
			if($iTitle) {
				//$resultStr.="<dt style=\"margin:5px;\">{$item['title']}";
				$resultStr.="<dt style=\"margin:5px;\">{$i} {$item['title']}";
				if($iAuthor) $resultStr.="&nbsp;by&nbsp;".substr($item['person'],0,3);
				$resultStr.="</dt>";
			}
			if($iText) $resultStr.="<dd style=\"margin-bottom:10px;\"> {$item['text']}</dd>";
			if($iTime) {
				$resultStr.="<dd style=\"margin-bottom:10px;\"> {$time} ";
				if($iMore) $resultStr.="- <a href=\"#\">查看详情</a>";
				$resultStr.="</dd>";
			}
			//echo $result['text']."&nbsp;by&nbsp;".$result['person'];
		}
		$resultStr.="</dl>";
		return $resultStr;
	}
	public function tinyList(){
		return $this->lList(9,true,false,false,false,false);
	}
	public function indexList(){
		return $this->lList(5,true,false);
	}
	public function allList(){
		return $this->lList(-1,true,false);
	}
}
?>