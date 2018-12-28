<?php
// error_reporting(0);

define('DS', DIRECTORY_SEPARATOR);
define('RootPath', dirname(__FILE__)."/../");      // 项目根路径
require __DIR__."/../vendor/autoload.php";

System\Init::instance()->start(); // 初始化框架
