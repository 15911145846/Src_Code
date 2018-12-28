<?php
use \System\Route;

Route::group(['prefix'=>''],function(){ // prefix master
	// 首页
	Route::get('/', 'Web\IndexController@index');

});
