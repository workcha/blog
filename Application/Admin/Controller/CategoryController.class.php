<?php 
	/**
	 * project : simple-blog
	 * user : chaohui
	 * date : 2018/9/13
	 * time : 21:36
	 */
	namespace Admin\Controller;
	use Think\Model;

	/**
	* 文章分类控制器
	*/
	class CategoryController extends BaseController
	{
		/**
		 * 首页处理
		 * 查询所有分类
		 * @return [type] [description]
		 */
		public function index()
		{	
			$model = new Model('Category');
			$list = $model->select();
			$this->assign('list', $list);
			$this->display();
		}
		/**
		 * 添加分类
		 */
		public function add()
		{
			if (IS_POST) {
				$model = new Model('Category');
				$name = I('name');
				$isNav = I('isNav', 1);
				$sort = I('sort', 0);
				if (empty($name)) {
					$this->error('请输入分类名称');
				}
				$isExists = $model->where(array('name' => $name))->find();
				$data = array(
					'name' => $name,
					'isNav' => $isNav,
					'sort' => $sort
				);
				if (!$model->data($data)->add()) {
					$this->error('添加失败');
				}
				$this->success('添加成功', U('admin/category/index'));
			}else{
				$this->display('post');
			}
		}
		/**
		 * 文章编辑
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function edit($id)
		{
			$model = new Model('Category');
			$data = $model->find($id);
			if (empty($data)) {
				$this->error('分类不存在', U('admin/category/index'));
			}
			if (IS_POST) {
				$name = I('name');
				$isNav = I('isNav', 1);
				$sort = I('sort', 0);				
				if (empty($name)) {
					$this->error('请输入分类名称');
				}
				$data = array(
					'name' => $name,
					'isNav' => $isNav,
					'sort' => $sort
				);
				if (!$model->where(array('categoryId' => $id))->save($data)) {
					$this->error('编辑失败');
				}
				$this->success('编辑成功', U('admin/category/index'));
			}
			else{
				$this->assign('data', $data);
				$this->display('post');
			}
		}
		/**
		 * 删除文章分类
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function delete($id)
		{
			$model = new Model('Category');
			$category = $model->find($id);
			if (empty($category)) {
				$this->error('分类不存在');
			}
			if ($category['total'] > 0) {
				$this->error('该分类下有文章，不可删除');
			}
			if (!$model->delete($id)) {
				$this->error('删除失败');
			}
			$this->success('删除成功', U('admin/category/index'));
		}
	}
 ?>