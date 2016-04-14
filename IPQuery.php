<?php
class IPQuery {
	private static $_requestURL = 'http://ip.taobao.com/service/getIpInfo.php';
	public static function getIPInfo($ip){
		$long = ip2long($ip);
		if($long === 0){
			throw new Exception('IP address error', 5);
		}
		$ip=long2ip($long);
		$IPInfo = self::queryIPInfo($ip);
		return self::parseJSON($IPInfo);
	}
	
	private static function queryIPInfo($ip){
		$query = http_build_query(array('ip'=>$ip));
		$ch = curl_init();
		$options = array(
				CURLOPT_URL => sprintf('%s?%s', self::$_requestURL, $query),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_AUTOREFERER => false,
				CURLOPT_FOLLOWLOCATION => false,
				CURLOPT_HEADER => false,
				CURLOPT_TIMEOUT => 3.0,
		);
		curl_setopt_array($ch, $options);
		$content = curl_exec($ch);
		curl_close($ch);
		return $content;
	}
	
	private static function parseJSON($json){
		$O = json_decode ($json, true);
	
		if(false === is_null($O)){
			return $O;
		}
		if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
			$errorCode = json_last_error();
			if(isset(self::$_JSONParseError[$errorCode])){
				throw new Exception(self::$_JSONParseError[$errorCode], 5);
			}
		}
		throw new Exception('JSON parse error', 5);
	}
	
	private static $_JSONParseError = array(
			JSON_ERROR_NONE=>'No error has occurred',
			JSON_ERROR_DEPTH=>'The maximum stack depth has been exceeded',
			JSON_ERROR_CTRL_CHAR=>'Control character error, possibly incorrectly encoded',
			JSON_ERROR_STATE_MISMATCH=>'Invalid or malformed JSON',
			JSON_ERROR_SYNTAX=>'Syntax error',
			JSON_ERROR_UTF8=>'Malformed UTF-8 characters, possibly incorrectly encoded',
	);
}
function getBrowse()
{
    global $_SERVER;
    $Agent = $_SERVER['HTTP_USER_AGENT'];
    $browseinfo='';
    if(preg_match('/Mozilla/', $Agent) && !preg_match('/MSIE/', $Agent)){
        $browseinfo = 'Netscape Navigator';
    }
    if(preg_match('/Opera/', $Agent)) {
        $browseinfo = 'Opera';
    }
    if(preg_match('/Mozilla/', $Agent) && preg_match('/MSIE/', $Agent)){

        $browseinfo = 'Internet Explorer';
    }
    if(preg_match('/Chrome/', $Agent)){
        $browseinfo="Chrome";
    }
    if(preg_match('/Firefox/', $Agent)){
        $browseinfo="Firefox";
    }

    return $browseinfo;
}
function getOS ()
{
    global $_SERVER;
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os = false;
    if (preg_match('/win/i', $agent) && strpos($agent, '95')){
        $os = 'Windows 95';
    }elseif (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')){
        $os = 'Windows ME';
    }elseif (preg_match('/win/i', $agent) && preg_match('98', $agent)){
        $os = 'Windows 98';
    }elseif (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)){
        $os = 'Windows XP';
    }elseif (preg_match('/win/i', $agent) && preg_match('/nt 5.2/i', $agent)){    
        $os = 'Windows 2003';
    }elseif (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)){
        $os = 'Windows 2000';
    }elseif (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)){
        $os = 'Windows NT';
    }elseif (preg_match('/win/i', $agent) && preg_match('32', $agent)){
        $os = 'Windows 32';
    }elseif (preg_match('/linux/i', $agent)){
        $os = 'Linux';
    }elseif (preg_match('/unix/i', $agent)){
        $os = 'Unix';
    }elseif (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)){
        $os = 'SunOS';
    }elseif (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)){
        $os = 'IBM OS/2';
    }elseif (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)){
        $os = 'Macintosh';
    }elseif (preg_match('/PowerPC/i', $agent)){
        $os = 'PowerPC';
    }elseif (preg_match('/AIX/i', $agent)){
        $os = 'AIX';
    }elseif (preg_match('/HPUX/i', $agent)){
        $os = 'HPUX';
    }elseif (preg_match('/NetBSD/i', $agent)){
        $os = 'NetBSD';
    }elseif (preg_match('/BSD/i', $agent)){
        $os = 'BSD';
    }elseif (preg_match('/OSF1/i', $agent)){
        $os = 'OSF1';
    }elseif (preg_match('/IRIX/i', $agent)){
        $os = 'IRIX';
    }elseif (preg_match('/FreeBSD/i', $agent)){
        $os = 'FreeBSD';
    }elseif (preg_match('/teleport/i', $agent)){
        $os = 'teleport';
    }elseif (preg_match('/flashget/i', $agent)){
        $os = 'flashget';
    }elseif (preg_match('/webzip/i', $agent)){
        $os = 'webzip';
    }elseif (preg_match('/offline/i', $agent)){
        $os = 'offline';
    }else{
        $os = 'Unknown';
    }
    return $os;
}
?>