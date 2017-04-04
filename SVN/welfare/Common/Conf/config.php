<?php
return array(
	//'配置项'=>'配置值'
	 'APP_STATUS'            => 'debug',
	//'ACTION_SUFFIX'         =>  'Action',
	//'CONTROLLER_LEVEL'      =>  2,
	
	//Action参数绑定
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
	//'URL_MODEL' 			=>  2,    //设置URL为重写模式，以在路由中隐藏入口文件
	//'URL_PARAMS_BIND_TYPE'  =>  1, // 设置参数绑定按照变量顺序绑定
	//'URL_PARAMS_BIND'       =>  false
	
	//伪静态
	//'URL_HTML_SUFFIX'=>'shtml'
	'URL_HTML_SUFFIX'=>'',   //All
	
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'maitian', // 数据库名
	'DB_USER'   => 'maitian', // 用户名
	'DB_PWD'    => '5438250', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集

	//项目自定义全局变量
	'STATIC_RESOURCE' => '/maitian/welfare/Common/Static', //系统的静态资源所在路径
	'COMMON_GATE' => '/maitian/welfare/index.php/Home',    //系统共有路径
	
);
