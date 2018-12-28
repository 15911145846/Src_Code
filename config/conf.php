<?php

// $GLOBALS

/**
 * SESSION_CACHE_LIMITER 指定缓存机制名字
 */

$SessionConf = [
	'SESSION_AUTO_OPEN'	=>	true, // 自动启用 session
	'SESSION_NAME' => 'src_code', // 用在 cookie 或者 URL 中的会话名称
	'SESSION_SAVEPATH' => RootPath."resources/session/", // 指定Session文件存储目录，如果不指定按照PHP默认配置存储。
	'SESSION_USE_COOKIES' => 1, // sessionid在客户端采用的存储方式，置1代表使用cookie记录客户端的sessionid
	'SESSION_CACHE_EXPIRE' => 1, // Session的缓存有效期，单位为分钟
	'SESSION_CACHE_LIMITER' => 'public', // 指定缓存机制名字
	'SESSION_GC_PROBABILITY' => '0.1', // 每次请求时触发Session失效缓存清理的概率,取值范围：0.0-1.0
	'SESSION_MAX_LIFETIME' => 120, // Session数据在服务器端储存的时间，如果超过这个时间，那么Session数据就自动删除
	'SESSION_PREFIX' => '',
	'SESSION_SAVE_HANDLER' => 'files',
];

$Twig = [
	'cache_dir' => false, //开启缓存
	'debug' => false, //开启调试模式（dump函数可用）
	'auto_reload' => true,
	'templates_path' => RootPath."apps".DS."%s".DS."views",
	'templates_suffix' => '.phtml',
	'compilation_cache' => RootPath."resources".DS."runtime".DS."cache",
];

$VerifyConf = [
	'expire' => 150,
	'imageH' => 50,
	'imageW' => 180,
	'length' => 5,
	'fontSize' => 20,
	'useImgBg' => false,
	'useNoise' => false,
	'bg' => array(243, 251, 254),
	'ttf' => '7',
];

$logConf = [
	'State' => true, // 页面上是否显示错误详细信息 false/true
	'debug.log' => RootPath."resources/runtime/logs/debug.log",
	'error.log' => RootPath."resources/runtime/logs/error.log",
	'access.log' => RootPath."resources/runtime/logs/access.log",
];

$database = [


	'read' => [
		'driver'    => 'mysql',
		'host'      => '127.0.0.1',
		'port' 		=> '3306',
		'database'  => 'test',
		'username'  => 'root',
		'password'  => '123456',
		'charset'   => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix'    => 'dm_',
	],

];

$aliyunoss = [
	//oss配置
    "OSS_ACCESS_ID" => 'OSS_ACCESS_ID',
    "OSS_ACCESS_KEY"=> 'OSS_ACCESS_KEY',
    "OSS_ENDPOINT"  => 'oss-cn-beijing.aliyuncs.com',
    "OSS_TEST_BUCKET" => 'phpwebj',
    "OSS_WEB_SITE" =>'phpwebj.oss-cn-beijing.aliyuncs.com',    //上面4个就不用介绍了，这个OSS_WEB_SITE是oss的bucket创建后的外网访问地址，如需二级域名，可以指向二级域名，具体可以参考阿里云控制台里面的oss

    //oss文件上传配置
    'oss_maxSize' => 11168199858,    //1M
    'oss_exts' => [// 设置附件上传类型
    				'audio/mpeg',
                    'image/jpg',
                    'image/gif',
                    'image/png',
                    'image/jpeg',
                    'video/mp4',
                    'application/zip',
                    'application/octet-stream',//阿里云好像都是通过二进制上传，似乎上面4个后缀设置起到什么用？
                ],
];
