<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo C('site.name');?></title>
	<link href="/blog/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/blog/public/admin/css/admin.css">
	<!--[if lt IE 9]>
	<script src="/blog/public/vendor/compatible/html5shiv.min.js"></script>
	<script src="/blog/public/vendor/compatible/respond.js"></script>
	<![endif]-->
	<script src="/blog/public/vendor/jquery.min.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand hidden-sm" href="<?php echo U('admin/index/index');?>">后台首页</a>
		</div>
		<div class="navbar-collapse collapse" role="navigation">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo U('admin/article/index');?>">文章管理</a></li>
				<li><a href="<?php echo U('admin/category/index');?>">分类管理</a></li>
				<li><a href="<?php echo U('admin/comment/index');?>">评论管理</a></li>
				<li><a href="<?php echo U('admin/link/index');?>">友情链接</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right hidden-sm">
				<li><a href="<?php echo U('admin/index/profile');?>">个人中心</a></li>
				<li><a href="<?php echo U('admin/index/logout');?>">退出登录</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">最近登录</div>
		<div class="panel-body">
			<ul>
				<li>上次登录时间：<?php echo (date('Y-m-d H:i:s',$_SESSION['admin']['loginAt'])); ?></li>
				<li>上次登录地址：<?php echo ($_SESSION['admin']['loginIp']); ?></li>
			</ul>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">修改密码</div>
		<div class="panel-body">
			<form action="/blog/admin/index/profile.html" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="password" class="col-md-1">新密码</label>
					<div class="col-md-4">
						<input type="password" id="password" class="form-control" name="password" required>
					</div>
				</div>
				<div class="form-group">
					<label for="repassword" class="col-md-1">密码确认</label>
					<div class="col-md-4">
						<input type="password" id="repassword" class="form-control" name="repassword" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-2 col-md-offset-1">
						<button class="btn btn-primary btn-block">修改</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="/blog/public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>