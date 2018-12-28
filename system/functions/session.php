<?php 
use System\Session;

/**
 * 处理name按.分隔，支持\.转义不分隔
 * @param string $name
 */
function &parseCfgName($name)
{
	$result = preg_split('#(?<!\\\)\.#', $name);
	array_walk($result,function(&$value,$key){
		if(false !== strpos($value,'\.'))
		{
			$value = str_replace('\.','.',$value);
		}
	});
	return $result;
}

/**
 * [session session操作]
 * @param  string $type [description]
 * @param  [type] $key  [description]
 * @param  string $val  [description]
 * @return [type]       [description]
 */
function session($type = 'set',$key = '',$val = '')
{
	// 设置一个session
	if (!empty($key) && $type == 'set') 
	{
		Session::$type($key,$val);
	}
	// 获取一个session
	if (!empty($key) && $type == 'get') 
	{
		$val = !empty($val) ? true : false;

		return Session::$type($key,$val);
	}
	// 删除一个session
	if (!empty($key) && $type == 'delete') 
	{
		Session::$type($key);
	}
	// 清空所有Session
	if ($type == 'clear') 
	{
		Session::$type();
	}
	// 暂停Session
	if ($type == 'pause') 
	{
		Session::$type();
	}
	// 停止Session
	if ($type == 'stop') 
	{
		Session::$type();
	}
}
