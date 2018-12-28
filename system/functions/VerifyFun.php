<?php 
use System\Config;
use System\Verify;

/**
 * [GetCodeObj 实例化验证码类]
 * @author jzz
 */
function GetCodeObj() {
	return New Verify($GLOBALS['_VERIFY']); //实例化一个对象
}

/**
 * [GetCodeData 获取验证码图像]
 * @param string $CodeId [设置验证码标识id]
 * @author jzz
 */
function GetCode() {
	$CodeObj = GetCodeObj();
	$CodeId = !empty($GLOBALS['_VERIFY']['CodeId']) ? $GLOBALS['_VERIFY']['CodeId'] : '';
	return $CodeObj->entry($CodeId);
}

/**
 * [CheckCode 验证验证码是否正确]
 * @param string $Code   [用户验证码]
 * @param string $CodeId [验证码标识]
 * @author jzz
 */
function CheckCode($Code = '') {
	global $Config;
	$CodeObj = GetCodeObj();
	$CodeId = !empty($GLOBALS['_VERIFY']['CodeId']) ? $GLOBALS['_VERIFY']['CodeId'] : '';
	return $CodeObj->check($Code, $CodeId);
}