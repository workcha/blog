<?php
$db = require __DIR__ . '/db.php';
$config = array(
	# 设置默认模块,增加一个后台管理模块
	'DEFAULT_MODULE' => 'Home',
	'URL_CASE_INSENSITIVE' => false,
	'URL_MODEL' => 2,
	'site' => array(
		'name' => 'C H A K U I博客'
	),
	'MODULE_ALLOW_LIST' => array('Home', 'Admin'),

	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => '/blog/public',
	),
	'LAYOUT_ON' => true
);
# 合并数组
return array_merge($config, $db);
