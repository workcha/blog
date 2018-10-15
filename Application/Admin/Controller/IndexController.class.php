<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Image;
use Think\Model;
use Think\Upload;
/**
 * project : simple-blog
 * user : chaohui
 * date : 2018/9/13
 * time : 16:13
 */
/**
 * 首页控制器
 */
class IndexController extends BaseController {
	/**
	 * 
	 * @var array 不需要登录的操作
	 */
	protected $publicActions = array(
		'login'
	);
	/**
	 * 如果访问除了登录界面而且没有session的用户都不允许访问
	 * 然后重定向到登陆界面
	 */
	protected function _initialize()
	{	
		#ACTION_NAME 当前操作名
		if (!in_array(ACTION_NAME, $this->publicActions) && session('admin.adminId') === null) {
			$this->error('请登录', U('admin/index/login'));
		}
	}
	/**
	 * 接受前端的post数据，在验证正确之后写入session
	 * @return [type] [description]
	 */
	public function login()
	{
		#登录只能是用post传输了，用get太露骨了
		if (IS_POST) {
			$model = new Model('admin');
			$username = I('username');
			$password = I('password');
			$admin = $model->where(array('username' => $username, 'password' => saltEncrypt($password)))->find();
			
			/*
				调试程序
			 $all = $model->where(array('username' => $username))->find();
			echo saltEncrypt($password);
			print_r($all);
			echo md5('chaohuisimple-blog');
			exit();*/
			if (empty($admin)) {
				$this -> error('账号或者密码错误');
			}
			#登录成功
			session('admin.adminName', $admin['username']);
			session('admin.adminId', $admin['adminId']);
			session('admin.loginAt', $admin['loginAt']);
			session('admin.loginIp', $admin['loginIp']);
			# 更新时间
			$data = array('loginAt' => time(), 'loginIp' => get_client_ip());
			$model->where(array('adminId' => $admin['adminId']))->save($data);
			$this->redirect('admin/index/index');
		}
		C('LAYOUT_NAME', 'simple');
		$this->display();
	}
    public function index(){
    	C('LAYOUT_NAME', 'admin');
    	$this->display();
    }
    public function logout()
    {
    	session_destroy();
    	$this->redirect('admin/index/login');
    }
    /**
     * 实现修改密码
     * @return [type] [description]
     */
    public function profile()
    {
    	if (IS_POST) {
    		$password = I('password');
    		$repassword = I('password');
    		if (!empty($password) && $password != $repassword) {
    			$this->error('确认密码不一致');
    		}
    		$data = array('password' => saltEncrypt($password));
    		$model = new Model('Admin');
    		$result = $model->where(array('adminId' => session('admin.adminId')))->save($data);
    		if ($result === false) {
    			$this->error('修改失败');
    		}else{
    			$this->success('修改成功');
    		}
    	}else{
    		C('LAYOUT_NAME', 'admin');	
    		$this->display();
    	}
    }
    /**
     * 上传处理
     * @return [type] [description]
     */
	public function upload()
	{
		$upload = new Upload();// 实例化上传类
		$upload->maxSize = 1024 * 1024 * 2;// 设置附件上传大小
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath = __DIR__ . '/../../../upload/'; // 设置附件上传根目录
		$upload->savePath = ''; // 设置附件上传（子）目录
		// 上传文件
		$info = $upload->upload();
		if (!$info)
		{
			$this->ajaxReturn(array(
				'error' => $upload->getError()
			));
		}
		else
		{
			$path = $upload->rootPath . $info['file']['savepath'] . $info['file']['savename'];
			$image = new Image();
			$image->open($path);
			$image->thumb(200, 200, Image::IMAGE_THUMB_CENTER)->save($path);
			$this->ajaxReturn(array(
				'url' => U('/', '', false, true) . 'upload/' . $info['file']['savepath'] . $info['file']['savename']
			));
		}
	}
}