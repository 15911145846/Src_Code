<?php 
namespace System;

Class Config extends \System\Singleton{

	public function get($ConfName = '',$field = ''){
		if (empty($ConfName)) {
			return '';
		}
		require RootPath."config".DS."conf.php";
		if (!empty($$ConfName) && empty($field)) {
			return $$ConfName;
		}
		if (!empty($$ConfName) && !empty($field)) {
			return self::check($$ConfName,$field);
		}
	}

	public function check($conf,$val,$default = null){
		return !empty($conf[$val]) ? $conf[$val] : $default;
	}

}