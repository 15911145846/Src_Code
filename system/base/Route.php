<?php
namespace System;
use System\Config;
use System\Org\IocInjection;
use \NoahBuscher\Macaw\Macaw;


/**
 * 路由
 */
class Route
{
	public static $Config;
	public static $master;
	public static $prefix;

	/**
	 * [group 处理路由分组信息]
	 * @author jiazhizhong
	 * @DateTime 2018-10-12T20:04:55+0800
	 * @param    array                    $Cinfig    [description]
	 * @param    [type]                   $RouteInfo [description]
	 * @return   [type]                              [description]
	 */
	public static function group($Config = [], $RouteInfo) {
		Route::$Config = $Config;
		//dump($Config);
		if (!empty($Config['master'])) {
			Route::$master = "/" . $Config['master'];
		}
		if (!empty($Config['namespace']) && empty($Config['master'])) {
			Route::$master = "/" . $Config['namespace'];
		}
		if (empty($Config['master']) && !empty($Config['prefix']) && empty($Config['namespace'])) {
			Route::$prefix = "/" . $Config['prefix'];
		}else if(!empty($Config['prefix'])){
			Route::$prefix = $Config['prefix'];
		}
		if (!empty(Route::$Config['middleware']) && !empty(Route::$Config['namespace'])) {
			Route::middleware(Route::$Config);
		}
		$result = $RouteInfo();
		if (empty($result)) {
			Route::$master = '';
		}
	}

	/**
	 * [middleware 执行中间件]
	 * @author jiazhizhong
	 * @DateTime 2018-10-24T23:20:25+0800
	 * @param    array                    $Config [description]
	 * @return   [type]                           [description]
	 */
	private static function middleware($Config = []){
		$UrlStr = Route::Url();
		if (!empty($Config['prefix']) && $Config['prefix'] != $UrlStr) {
			return false;
		}
		if (empty($Config['middleware'])) {
			return false;
		}
		$Middleware = "\\" . $Config['namespace'] . "\\Middleware\\" . $Config['middleware'];
		$res = IocInjection::make($Middleware, 'handle');
		if (is_array($res)) {
            dump($res);
        }
        if($res != 1){
            echo $res;exit;
        }
	}

	public static function Url(){
		if (empty($_SERVER['REQUEST_URI'])) {
			return [];
		}
		$UrlInfo = array_filter(explode("/", $_SERVER['REQUEST_URI']));
		return !empty($UrlInfo[2]) ? $UrlInfo[2] : '';
	}

	/**
	 * [__callStatic 处理路由请求及请求方式]
	 * @author jiazhizhong
	 * @DateTime 2018-10-12T20:04:22+0800
	 * @param    [type]                   $name      [description]
	 * @param    [type]                   $arguments [description]
	 * @return   [type]                              [description]
	 */
	public static function __callStatic($name, $arguments){
		$Info = $arguments[1];
		$Routes = $arguments[0];
		if (!empty(Route::$Config['master']) && !empty(Route::$Config['prefix'])) {
			Route::$prefix = Route::$Config['master'];
		}
		// if (!empty(Route::$Config['master']) && empty(Route::$Config['prefix'])) {
		// 	Route::$prefix = Route::$Config['master'];
		// }
		if (!empty(Route::$Config['prefix'])) {
			Route::$prefix = Route::$Config['prefix'];
		}
		$RoutesStr = '';
		if (!empty(Route::$master) && $Routes != '/') {
			$RoutesStr = Route::$master . "/";
		}else if($Routes == '/'){
			$RoutesStr .= $Routes;
		}
		if (!empty(Route::$prefix) && $Routes != '/') {
			$RoutesStr .= Route::$prefix . "/";;
		}
		if (!empty($Routes) && $Routes != '/') {
			$RoutesStr .= $Routes;
		}

		Route::$prefix = '';
		// dump(Route::$master);
		// echo $RoutesStr."</br>";
		Macaw::$name($RoutesStr, $Info);
	}
}
