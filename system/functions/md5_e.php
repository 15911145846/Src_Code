<?php 
use System\Org\MD5;

/**
 * md5加密
 * @author jzz
 */
function getMd5($str = '') {
	$obj = New MD5($str);
	return $obj->getDigist();
}