<?php
namespace System;

/**
 * 用户Serivce基类
 * @author jzz
 */
Class BaseService extends \System\Singleton{

	/**
	 * [__construct 构造方法]
	 * @author jzz
	 */
	public function __construct($Args = array()) {
		$this->_init($Args);
	}

	/**
	 * [__get 处理未定义属性]
	 * @param  [type] $Attributename [属性名称]
	 * @author jzz
	 */
	public function __get($Attributename) {
		return $this->$Attributename = NULL;
	}

	/**
	 * [__call 处理未定义方法]
	 * @param  [type] $Method [方法名]
	 * @param  [type] $args   [参数]
	 * @author jzz
	 */
	public function __call($Method, $args) {
		if ($Method !== '_init') {
			$model_name = str_replace('_','\\',$Method);
			return M("{$model_name}");
		}
		
		
	}
}