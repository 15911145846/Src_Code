<?php 
use System\Cookie;

/**
 * 获取一个cookie对象
 * @author jzz
 */
function Obj() {
	return New Cookie();
}

/**
 * [cookie Cookie操作]
 * @param  string $type [操作类型]
 * @param  string $key  [键]
 * @param  string $val  [值]
 * @param  string $Time [过期时间，分钟]
 * @return [type]       [description]
 */
function cookie($type = 'set',$key = '',$val = '',$Time = '')
{
	$obj = Obj();
	$Time = $Time*60;
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	// 设置一个Cookie
	if (!empty($key) && $type == 'set') 
	{
		$obj->$type($key,$val,$Time,$domain);
	}
	// 获取一个Cookie
	if (!empty($key) && $type == 'get') 
	{
		return $obj->$type($key);
	}
	// 更新一个Cookie
	if (!empty($key) && $type == 'up') 
	{
		$obj->update($key,$val);
	}
	// 删除一个Cookie
	if (!empty($key) && $type == 'del') 
	{
		$obj->set($key, '' , time() - 1000, $domain);
		$obj->$type();
	}
}
