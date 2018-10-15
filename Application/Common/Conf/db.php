<?php 
	/**
	 * project : simple blog
	 * user : chaohui
	 * date : 2018/9/13
	 * time : 13:36
	 */
	return array(
		'DB_TYPE' => 'mysql',
		'DB_DSN' => 'mysql:host=localhost;dbname=blog;charset=utf8',
		'DB_USER' => 'root',
		'DB_PWD' => 'root',
		'DB_PREFIX' => 'blog_',
		'DB_PARAMS' => array(
			PDO::ATTR_CASE => PDO::CASE_NATURAL
		)
	);
 ?>