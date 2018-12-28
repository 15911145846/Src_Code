<?php
use System\LogMsg;

function dump($data = []){
	print_r('<pre>');
	print_r($data);
}

/*
 * 数组 转 对象
 * @param array $arr 数组
 * @return object
 */
function arrayToObject($arr){
    if (gettype($arr) != 'array') {
        return;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array') {
            $arr[$k] = (object)arrayToObject($v);
        }
    }
    return (object)$arr;
}

/*
 * 对象 转 数组
 * @param array $arr 数组
 * @return object
 */
function objectToArray($array){
    if (is_object($array)) {
        $array = (array)$array;
    }
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            $array[$key] = objectToArray($value);
        }
    }
    return $array;
}

/*
 * 处理返回数据
 * @param $msg
 * @param int $code
 * @param string $data
 * @return json
 */
function result($msg, $code = 0, $data = "", $count = -1){
    $res['msg'] = $msg;
    $res['code'] = $code;
    $res['data'] = $data;
    if ($count >= 0) {
        $res['count'] = $count;
    }
    header('Content-Type:application/json; charset=utf-8');
 	return json_encode($res);
}

/*
 * api Resources data
 * @param $msg 响应结果
 * @param $code 响应代码
 * @param $data 响应数据
 */
function resources($msg, $code = 0, $data = "")
{
    $res = array();
    $res['msg'] = $msg;
    $res['code'] = $code;
    $res['data'] = $data;
    header('Content-Type:application/json; charset=utf-8');
    return json_encode($res,JSON_PRETTY_PRINT);
}

/*
 * api Resource data
 * @param $msg 响应结果
 * @param $code 响应代码
 * @param $data 响应数据
 */
function Resource($msg, $code = 0, $data = "")
{
    $res = array();
    $res['message'] = $msg;
    $res['code'] = $code;
    $res['data'] = $data;
    header('Content-Type:application/json; charset=utf-8');
    return json_encode($res,JSON_PRETTY_PRINT);
}

/*
 * 格式化后台完整地址
 * @param $resource
 * @return url
 */
function adminurl($resource = ""){
    return $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $resource;
}

/**
 * [show_err 错误提示]
 * @param  string $message [错误内容]
 * @return [type]          [description]
 * @author jzz
 */
function show_err($message = 'NULL'){
	LogMsg::showError(['message' => "{$message}"]);
}

/**
 * [show_err 日志写入]
 * @param  string $log_w [日志写入类型] alert,error,access,warning,notice
 * @param  array $info [日志内容]
 * @author jzz
 */
function parse_log($log_w = 'alert',$info = ['Bar' ,['null']]){
	LogMsg::parse($log_w,$info);
}

function GetEnvInfo($file = ''){
	if (empty($file)) {
		return [];
	}
	if (!file_exists($file)){
		return [];
	}
	$data = [];
	$EnvFileInfo = file($file);

	if (!empty($EnvFileInfo)) {
		foreach ($EnvFileInfo as $EnvKey => $EnvValue) {
			$EnvInfo = explode('=', $EnvValue);
			$val = !empty($EnvInfo[1]) ? $EnvInfo[1] : '';
			if (!empty($EnvInfo[0]) && $EnvInfo[0] != "\n") {
				$data[$EnvInfo[0]] = $val;
			}
		}
	}
	return $data;
}

/**
 * [behavior_log 用户行为日志记录]
 * @return [type] [description]
 */
function behavior_log(){
	if (!empty($_SERVER['SCRIPT_URI'])) {
		$SCRIPT_URI = GetIp()." : ".$_SERVER['SCRIPT_URI'];
		parse_log('access',['access',["{$SCRIPT_URI}"]]);
	}else{
		$URL = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['DOCUMENT_URI'] . $_SERVER['REQUEST_URI'];
		$SCRIPT_URI = GetIp() . " : " . $URL;
		parse_log('access',['access',["{$SCRIPT_URI}"]]);
	}

}

/**
 * [GetIp 获取用户端IP]
 * @author jzz
 */
function GetIp() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
		$ip = getenv("REMOTE_ADDR");
	} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} else {
		$ip = "unknown";
	}
	return $ip;
}

/**
 * 加密算法
 * @author jzz
 */
function encrypt($data, $key, $char = '', $str = '') {
	$key = md5($key);
	$x = 0;
	$len = strlen($data);
	$l = strlen($key);
	for ($i = 0; $i < $len; $i++) {
		if ($x == $l) {
			$x = 0;
		}
		$char .= $key{$x};
		$x++;
	}
	for ($i = 0; $i < $len; $i++) {
		$str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
	}
	return base64_encode($str);
}

/**
 * 解密算法
 * @author jzz
 */
function decrypt($data, $key, $char = '', $str = '') {
	$key = md5($key);
	$x = 0;
	$data = base64_decode($data);
	$len = strlen($data);
	$l = strlen($key);
	for ($i = 0; $i < $len; $i++) {
		if ($x == $l) {
			$x = 0;
		}
		$char .= substr($key, $x, 1);
		$x++;
	}
	for ($i = 0; $i < $len; $i++) {
		if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
			$str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
		} else {
			$str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
		}
	}
	return $str;
}

/**
 * [M 实例化model模型]
 * @param string $ModelName [model名称]
 * @author jzz
 */
function M($ModelName = ''){
	if (empty($ModelName)) {
		show_err("实例化model模型失败！");
	}
	$ModelName = $ModelName."Model";
	return New $ModelName();
}

/**
 * [M 实例化Service模型]
 * @param string $ModelName [model名称]
 * @author jzz
 */
function S($ServiceName = ''){
	if (empty($ServiceName)) {
		show_err("实例化Serivice模型失败！");
	}
	$ServiceName = $ServiceName."Service";
	return New $ServiceName();
}

// 格式化时间
function dateFormat($time = ""){

    if($time == ""){

        return date('Y-m-d H:i:s');
    }
    return date('Y-m-d H:i:s', $time);
}

function setToken(){

    // 生成一个不会重复的字符串
    $str = md5(uniqid(md5(microtime(true)), true));
    // 进行加密
    $str = sha1($str);
    return $str;
}

function is_mobile($text) {
    $search = '/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
    if (preg_match($search, $text)) {
        return true;
    } else {
        return false;
    }
}
