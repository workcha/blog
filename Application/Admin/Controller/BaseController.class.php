<?php  
	/**
	 * project : simple-blog
	 * user : chaohui
	 * date : 2018/9/13
	 * time : 15:05
	 */
	namespace Admin\Controller;
	use Think\Controller;
	/**
	*  所有控制器都需要检测是否登录
	*  所以封装一个类，然后所有控制器类
	*  都继承这个类就可以了
	*/
	class BaseController extends Controller
	{
		
		protected function _initialize()
		{
			if (session('admin.adminId') === null) {
				$this->error('请登录', U('admin/index/login'));
			}
			C('LAYOUT_NAME', 'admin');
		}
	}
?>