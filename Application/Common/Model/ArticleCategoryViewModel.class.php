<?php  
	namespace Common\Model;
	use Think\Model\ViewModel;
	/**
	 * 由于两个模块都需要用到的，所以放在公共文件内
	 */
	class ArticleCategoryViewModel extends ViewModel
	{
		public $viewFields = array(
			'Article' => array('articleId', 'title', 'description','image', 'hits', 'createAt', 'updateAt', 'status', 'sort', 'content'),
			'Category' => array('categoryId', 'name', '_on' => 'Article.categoryId=Category.categoryId')
		);
	}
?>