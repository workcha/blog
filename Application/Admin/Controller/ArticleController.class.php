<?php  
	/**
	 * project : simple-blog
	 * user : chaohui
	 * date: 2018/9/13
	 * time : 19:13
	 */
	namespace Admin\Controller;
	use Common\Model\ArticleCategoryViewModel;
	use Think\Model;
	use Org\Net\Http;
	use Think\Page;

	class ArticleController extends BaseController
	{
		public function index()
		{
			$model = new ArticleCategoryViewModel();
			$count = $model->count();
			$page = new Page($count);
			$show = $page->show();
			$list = $model->order('articleId DESC')->limit($page->firstRow . ',' . $page->listRows)->field('articleId,title,description,hits,createAt,updateAt,status,sort,name,categoryId')->select();
			$this -> assign('list', $list);
			$this -> assign('page', $page);
			$this -> display();
		}
		/**
		 * 增加文章
		 */
		public function add()
		{
			if (IS_POST) {
				$model = new Model('Article');
				$title = I('title');
				$description = I('description');
				$content = I('content');
				$image = I('image');
				$status = I('status', 1);
				$sort = I('sort', 0);
				$createAt = time();
				$categoryId = I('categoryId');
				if (empty($title))
				{
					$this->error('文章标题不能为空');
				}
				if (empty($content))
				{
					$this->error('文章内容不能为空');
				}
				if (empty($description))
				{
					$description = trim(mb_substr(strip_tags(htmlspecialchars_decode($content)), 0, 100, 'UTF-8'));
				}
				if (empty($categoryId))
				{
					$this->error('请选择分类');
				}
				$data = array(
					'Title' => $title,
					'Description' => $description,
					'content' => $content,
					'Image' => $image,
					'Status' => $status,
					'Sort' => $sort,
					'createAt' => $createAt,
					'categoryId' => $categoryId
				);
				if (!$model->data($data)->add())
				{
					$this->error('添加失败');
				}
				M('Category')->where(array('categoryId' => $categoryId))->setInc('total');
				$this->success('添加成功', U('admin/article/index'));
			}
			else
			{
				$categories = M('Category')->field('categoryId,name')->select();
				$this->assign('categories', $categories);
				$this->display('post');
			}
		}
		/**
		 * 编辑
		 */
		public function edit($id)
		{
			$model = new Model('Article');
			$article = $model->find($id);
			if (empty($article)) {
				$this->error('这篇文章不存在');
			}
			if (IS_POST) {
				$title = I('title');
				$description = I('description');
				$content = I('content');
				$image = I('image');
				$status = I('status', 1);
				$sort = I('sort', 0);
				$categoryId = I('categoryId');
				if (empty($title))
				{
					$this->error('文章标题不能为空');
				}
				if (empty($content))
				{
					$this->error('文章内容不能为空');
				}
				if (empty($description))
				{
					$description = trim(mb_substr(strip_tags(htmlspecialchars_decode($content)), 0, 100, 'UTF-8'));
				}
				if (empty($categoryId))
				{
					$this->error('请选择分类');
				}
				$data = array(
					'Title' => $title,
					'Description' => $description,
					'content' => $content,
					'Image' => $image,
					'Status' => $status,
					'Sort' => $sort,
					'updateAt' => time(),
					'categoryId' => $categoryId
				);
				if ($model->where(array('articleId' => $id)) -> save($data) === false) {
					$this->error('编辑失败');
				}
				#此处暂时不懂，得进行动态分析
				#传入$id查出来的数据中的categoryId怎么会和传入的categoryId不一样
				#不一样之后又为什么会进行下面操作
				if ($article['categoryId'] != $categoryId) {
					
					M('Category')->where(array('categoryId' => $articleId))->setInc('total');
					M('Category')->where(array('categoryId' => $article['categoryId']))->setDec('total');
				}
				$this->success('编辑成功', U('admin/article/index'));
			}
			else{
				$categories = M('Category')->field('categoryId,name')->select();
				$this->assign('categories', $categories);
				$this->assign('data', $article);
				$this->display('post');
			}
		}
		/**
		 * 删除文章操作
		 * @return [type] [description]
		 */							
		public function delete($id)
		{
			$model = new Model('Article');
			if ($model->delete($id) !== false) {
				$this->success('删除成功');
			}
			else{
				$this->error('删除失败');
			}
		}
	}
?>