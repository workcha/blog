<?php 
	/**
	 * project : simple-blog
	 * user : chaohui
	 * date : 2018/9/13
	 * time : 13:45
	 */
	
	/**
	 * 安全加密
	 * @param  $password
	 * @param  string $salt
	 * @return string
	 */
	function saltEncrypt($password, $salt = 'simple-blog')
	{
		return md5($password . $salt);
	}

	/**
	 * 将数组转化为xml
	 * @param  array $data      
	 * @param  string $rootNodeName  根节点
	 * @param  string $xml          
	 * @return [type]
	 */
	function array2xml($data, $rootNodeName='data', $xml=null)
	{
		#关闭兼容模式
		if (ini_get('zend.zel_compatibility_mode') == 1) {
			ini_set('zend.zel_compatibility_mode', 0);
		}
		if ($xml == null) {
			$xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
		}
		foreach ($data as $key => $value) {
			# xml没有数字关键字
			if (is_numeric($key)) {
				# 合成字符关键字
				# 其实这里个人感觉毫无用处，后面就会直接把$key的number以及字符替换没了
				$key = "unknowNode_" . (string)$key;
			}
			# 替换任何不是字母数值的东西
			$key = preg_replace('/[^a-z]/i', '', $key);
			if (is_array($value)) {
				$node = $xml -> addChild($key);
				# 如果是数组的话就回调这个函数
				array2xml($value, $rootNodeName, $node);
			}
			else{
				//增加一个节点
				$value = htmlentities($value);
				$xml -> addChild($key, $value);
			}
		}
		# 返回一个字符串或者xml对象,只要你想的话
		return $xml->asXML();
	}
	/**
	 * 获取分类
	 * @param  integer $isNav 
	 * @return array  查询出来的文章分类数组
	 */
	function getCategory($isNav = -1)
	{
		$map = array();
		if ($isNav > 1) {
			$map['isNav'] = $isNav;
		}
		$model = new \Think\Model('Category');
		return $model->where($map)->order('sort DESC')->select();
	}
	/**
	 * 获取友链
	 * @return array 友链数组
	 */
	function getLinks()
	{
		return M('Link') -> where(array('status' => 1)) -> order('linkId DESC') -> select();
	}
 ?>