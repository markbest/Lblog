<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ getConfig('web_title') }}</title>

	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/admin/admin.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
	<script src="{{ asset('/js/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
</head>
<body class="admin_body">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" /></a>
		</div>

		<ul class="nav navbar-top-links navbar-right">
			<li class="dropdown active">
				<a class="dropdown-toggle active" data-toggle="dropdown" href="###">
					<i class="fa fa-user fa-fw"></i>  {{ Auth::user()->name }}  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user in">
					<li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</nav>

	<div class="main-content">
		<div class="left-menu-aside">
			<div class="menu_dropdown" role="navigation">
				<ul>
					<li class="{{ active_class(if_uri_pattern(['admin/article*','admin']), 'active', '') }}">
						<a href="{{ url('admin/article') }}"><i class="fa fa-pencil-square-o fa-fw"></i> 文章管理</a>
					</li>
					<li class="{{ active_class(if_uri_pattern(['admin/category*']), 'active', '') }}">
						<a href="{{ URL('admin/category') }}"><i class="fa fa-dashboard fa-fw"></i> 分类管理</a>
					</li>
					<li class="{{ active_class(if_uri_pattern(['admin/file*']), 'active', '') }}">
						<a href="{{ URL('admin/file') }}"><i class="fa fa-briefcase fa-fw"></i> 资料管理</a>
					</li>
					<li class="{{ active_class(if_uri_pattern(['admin/customer*']), 'active', '') }}">
						<a href="{{ url('/admin/customer' )}}"><i class="fa fa-user fa-fw"></i> 用户管理</a>
					</li>
					<li class="{{ active_class(if_uri_pattern(['admin/picture*']), 'active', '') }}">
						<a href="{{ url('/admin/picture' )}}"><i class="fa fa-picture-o fa-fw"></i> 图片库</a>
					</li>
					<li class="{{ active_class(if_uri_pattern(['admin/setting']), 'active', '') }}">
						<a href="{{ url('/admin/setting' )}}"><i class="fa fa-cog fa-fw"></i> 基础设置</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="right-content-box" class="right-content-box">
			<div class="container">
				@yield('content')
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
