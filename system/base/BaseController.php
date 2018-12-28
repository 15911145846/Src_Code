<?php
namespace System;
use System\LogMsg;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

/**
 * 基础控制器
 * @author jzz
 */
Class BaseController extends \System\Singleton{

	/**
	 * [__construct 构造方法]
	 * @author jzz
	 */
	public function __construct(Request $request) {
		//$request->setLaravelSession();
		if (method_exists($this,'_init')) {
			$this->_init();
		}
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
		switch ($Method) {
		default:
			show_err("404 {$Method} => Method Not Found");
			//LogMsg::showError(['message' => "404 {$Method} => Method Not Found"]);
			break;
		}
	}

}
