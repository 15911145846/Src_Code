<?php
namespace System;
use System\Config;
use \NoahBuscher\Macaw\Macaw;

/**
 * 框架初始化
 * @author jzz
 */
Class Init extends \System\Singleton{

	/**
	 * [start 框架初始化化]
	 * @return [type] [description]
	 */
	public function start(){
		/* 初始化错误捕捉  */
		register_shutdown_function(array("System\LogMsg","_rare_shutdown_catch_error"));
		/* 加载各种公共文件及配置 */
		$this->file_require();
		$GLOBALS['_VERIFY'] = \System\Config::instance()->get('VerifyConf');
		$GLOBALS['_LOG'] = \System\Config::instance()->get('logConf');
		$GLOBALS['_DB'] = \System\Config::instance()->get('dbConf');
		// 自动启动session
		if(\System\Config::instance()->get('SessionConf','SESSION_AUTO_OPEN'))
		{
			Session::start();
		}
		/* 加载用户函数库 */
		$this->init_user_common();
		/* 加载路由配置 */
		$this->init_route();
		/* 记录用户行为日志 */
		behavior_log();
	}

	/**
	 * [init_route 加载路由配置]
	 * @return [type] [description]
	 */
	private function init_route(){

		$handler = opendir(RootPath."routes/");
		while( ($filename = readdir($handler)) !== false )
		{
			//略过linux目录的名字为'.'和‘..'的文件
			if($filename != "." && $filename != "..")
			{
				require RootPath."routes/{$filename}";
			}
		}
		Macaw::dispatch();
	}

	/**
	 * [init_route 加载用户函数库]
	 * @return [type] [description]
	 */
	private static function init_user_common(){
		require RootPath."config".DS."common.php";
	}

	/**
	 * [file_require 加载各种公共文件]
	 * @return [type] [description]
	 */
	private static function file_require(){
		$file_require = [
				'md5_e',
				'function',
				'cookie',
				'session',
				'VerifyFun',
				'makePass'
			];
		foreach ($file_require as $key => $value) {
			$path = RootPath."system".DS."functions".DS."{$value}.php";
			if (is_file($path)) {
				require $path;
			}
		}
	}
}
