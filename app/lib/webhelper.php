<?php
# Created By iAm[i]nE.
# www.iamine.com

class WebHelper {
	function sendMail($to, $from, $subject, $message) {
		$subject = sprintf('=?utf-8?B?' . base64_encode($subject) . '?=');
		$headers = sprintf("To: %s <%s>\nFrom: %s\nMIME-Version: 1.0\nContent-type: text/html; charset=utf-8", $to, $to, $from);
		
		return mail ( $to, $subject, $message, $headers );
	}
	
	function getDomain() {
		$surl = $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		$surl = preg_replace ( '/^(www\\.)/', '', $surl );
		
		$arr = split ( '/', $surl );
		$count = sizeof ( $arr ) - 1;
		if ($count > 0) {
			$surl = '';
			for($i = 0; $i < $count; $i ++) {
				$surl .= $arr [$i] . '/';
			}
		}
		
		return strtolower($surl);
	}
	
	function getBaseUrl() {
		return ( WebHelper::isSSL()? 'https://' : 'http://' ) . 
				$_SERVER ['HTTP_HOST'] . 
				strrev ( strstr ( strrev ( $_SERVER ['PHP_SELF'] ), '/' ) );
	}
	
	function isSSL() {
		return !(
			!isset($_SERVER['HTTPS']) 
			|| preg_match('/^(|off|false|disabled)$/i', $_SERVER['HTTPS']) 
		);
	}
	
	function getClientIP() {
		$ip = '';
		if ( isset ( $_SERVER ['REMOTE_ADDR'] ) ) {
			$ip = $_SERVER ['REMOTE_ADDR'];
		} else if ( isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
		} else if ( isset ( $_SERVER ['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER ['HTTP_CLIENT_IP'];
		}

		return $ip;
	}
}
