<?php 
namespace System;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * 日志写入及错误捕获
 * @author jzz
 */
Class LogMsg{

	protected static $logObj;

	/**
	 * [file_check 检查日志文件是否存在]
	 * @return [type] [description]
	 */
	private static function file_check(){
		$config = Config::instance()->get('logConf');

		foreach ($config as $log_name => $log_val) {
			if (!is_file($log_val) && $log_name !== 'State') {
				$myfile = fopen($log_val, "w");
			}
		}
	}

	/**
	 * [parse 调用日志写入函数]
	 * @return [type] [description]
	 */
	public static function parse($log_w = 'alert',$info = ['null']){
		$config = Config::instance()->get('logConf');
		self::$logObj = new Logger('SM');
		// 检查日志文件是否存在
		self::file_check();
		self::$log_w($info,$config);
	}

	private static function alert($info,$config){
		self::$logObj->pushHandler(new StreamHandler($config['debug.log'], Logger::ALERT));
		self::$logObj->alert('alert',$info);
	}

	private static function error($info,$config){
		self::$logObj->pushHandler(new StreamHandler($config['error.log'], Logger::ERROR));
		self::$logObj->error('error',$info);
	}

	private static function access($info,$config){
		self::$logObj->pushHandler(new StreamHandler($config['access.log'], Logger::INFO));
		self::$logObj->INFO('access',$info);
	}

	private static function warning($info,$config){
		self::$logObj->pushHandler(new StreamHandler($config['error.log'], Logger::WARNING));
		self::$logObj->INFO('warning',$info);
	}

	private static function notice($info,$config){
		self::$logObj->pushHandler(new StreamHandler($config['error.log'], Logger::NOTICE));
		self::$logObj->INFO('notice',$info);
	}

	/**
	 * [_rare_shutdown_catch_error 错误捕捉]
	 * @return [type] [description]
	 */
	public static function _rare_shutdown_catch_error(){
		$config = Config::instance()->get('logConf');
		$logObj = new Logger('SM');
		$_error = error_get_last();
	    // 错误级别
	    $_errorLevel = array(                                                                                            //
            0     => 'Exception',                   //异常
            1     => /* E_ */'ERROR',                     //致命的运行时错误。错误无法恢复。脚本的执行被中断。
            2     => /* E_ */'WARNING',                   //非致命的运行时错误。脚本的执行不会中断。
            4     => /* E_ */'PARSE',                     //编译时语法解析错误。解析错误只应该由解析器生成。
            8     => /* E_ */'NOTICE',                    //运行时提示。可能是错误，也可能在正常运行脚本时发生。
            16    => /* E_ */'CORE_ERROR',                //由 PHP 内部生成的错误。
            32    => /* E_ */'CORE_WARNING',              //由 PHP 内部生成的警告。
            64    => /* E_ */'COMPILE_ERROR',             //由 Zend 脚本引擎内部生成的错误。
            128   => /* E_ */'COMPILE_WARNING',           //由 Zend 脚本引擎内部生成的警告。
            256   => /* E_ */'USER_ERROR',                //由于调用 trigger_error() 函数生成的运行时错误。
            512   => /* E_ */'USER_WARNING',              //由于调用 trigger_error() 函数生成的运行时警告。
            1024  => /* E_ */'USER_NOTICE',               //由于调用 trigger_error() 函数生成的运行时提示。
            2048  => /* E_ */'STRICT',                    //运行时提示。对增强代码的互用性和兼容性有益。
            4096  => /* E_ */'RECOVERABLE_ERROR',         //可捕获的致命错误。
            8192  => /* E_ */'DEPRECATED',                //运行时通知。启用后将会对在未来版本中可能无法正常工作的代码给出警告。
            16384 => /* E_ */'USER_DEPRECATED',           //用户产少的警告信息。 
            30719 => /* E_ */'ALL',                       //所有的错误和警告，除了 E_STRICT。
        );
	    //  && in_array($_error['type'],array(1,4,8,16,64,256,4096,E_ALL))
	    if(!empty($_error)){
	    	$_error_info[] = $_errorLevel[$_error['type']].": ".$_error['message'];
	    	$_error_info[] = $_error['file'] . " on line " . $_error['line'];
	    	$logObj->pushHandler(new StreamHandler($config['error.log'], Logger::ERROR));
			$logObj->error('error',$_error_info);

			if ($config['State'] === false) {
				$_error['file'] = '';
				$_error['line'] = '';
				$_error['message'] = "亲，出错了快去看看日志是什么错！";
			}
			self::ShowError($_error);
		}
	}

	/**
	 * [showError 错误显示页]
	 * @param  [type] $_error [description]
	 * @return [type]         [description]
	 */
	public static function showError($_error){
		$config = Config::instance()->get('logConf');
		$_error_position_str = "";
		if (empty($_error)) {
			$_error_str = "亲，错误提示语不能为空！";
			require RootPath . DS . 'system/res/error.tpl';exit;
		}
		$_error_str = $_error['message'];
		if (!empty($_error['file']) && !empty($_error['line'])) {
			$_error_position_str = $_error['file'] . " on line " . $_error['line'];
		}else{
			$HTTP_HOST = !empty($_SERVER['SERVER_ADMIN']) ? $_SERVER['SERVER_ADMIN'] : $_SERVER['HTTP_HOST'];
			$REQUEST_SCHEME = !empty($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
			$from_str = $REQUEST_SCHEME."://".$HTTP_HOST.
						$_SERVER['SCRIPT_NAME'].$_SERVER['REQUEST_URI'];
			$logObj = new Logger('SM');
			$logObj->pushHandler(new StreamHandler($config['access.log'], Logger::ERROR));
			$logObj->error('access',[$from_str." -> ".$_error_str]);
		}
		require RootPath . DS . 'system/res/error.tpl';exit;
	}
}