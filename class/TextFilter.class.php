<?php

class TextFilter {
	/**
	 * 显示到屏幕上的文本的字符过滤
	 * @param string $content 要过滤的字符串
	 * @return string 返回替换后的字符串
	 */
	public static function showTextReplace($content) {
		$content = str_replace(
				array('"',"'","\\","/","<",">"),
				array("&quot;","&quot;","、","、","&lt;","&gt;"),
				$content);
		return $content;
	}
	/**
	 * 纯中文的文本的字符过滤
	 * @param string $content 要过滤的字符串
	 * @return string 返回替换后的字符串
	 */
	public static function chineseTextReplace($content) {
		$content = str_replace(
				array('"',"'","\\","/","<",">"),
				array("＂","＇","、","、","《","》"),
				$content);
		return $content;
	}
	/**
	 * 用户名等纯字符文本的过滤
	 * @param string $content 要过滤的字符串
	 * @return string 返回替换后的字符串
	 */
	public static function pureTextReplace($content) {
		$content = str_replace(
				array('"',"'","\\","/","<",">"),
				array("","","","","",""),
				trim($content));
		return $content;
	}
}

?>