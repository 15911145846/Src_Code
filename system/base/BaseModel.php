<?php
namespace System;
use System\LogMsg;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * 基础控制器
 * @author jzz
 * 开启mysql查询日志
 * DB::enableQueryLog();
 * dump(DB::getQueryLog());exit;
 */
Class BaseModel extends \System\Singleton
{

	public $capsule;
	public $config = [];

	public function __construct($type = 'read')
	{
		$this->config = Config::instance()->get('database');
		$this->capsule = new DB;
		$this->capsule->addConnection($this->config[$type]);
		$this->capsule->setEventDispatcher(new Dispatcher(new Container));
		$this->capsule->setAsGlobal();
		// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
		$this->capsule->bootEloquent();
		$this->boot();
	}

	/**
	 * [__get 自动获取表名]
	 * @param  [type] $Attributename [description]
	 * @return [type]                [description]
	 */
	public function __get($Attributename)
	{
		return strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $Attributename));
	}

	/**
	 * [boot description]
	 * @return [type] [description]
	 */
	public function boot()
	{
		/* 记录sql执行日志 */
		$this->SetSqlLog();
	}

	/**
	 * [SetSqlLog sql日志]
	 */
	public function SetSqlLog()
	{
		DB::listen(function($query) {
			$tmp = str_replace('?', '"'.'%s'.'"', $query->sql);
			$tmp = vsprintf($tmp, $query->bindings);
			$tmp = str_replace("\\","",$tmp);
			LogMsg::parse('alert',['SQL',[$tmp],["耗时: {$query->time}"]]);
			//Log::info($tmp."\n\n\t");
		});
	}

}
