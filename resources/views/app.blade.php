<!DOCTYPE html>
<html lang="en">
@include('parts.admin.head')
<body class="admin_body">
	<nav class="navbar navbar-default navbar-static-top active" role="navigation" style="margin-bottom:0px;">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">Mark-here</a>
		</div>

		<ul class="nav navbar-top-links navbar-right in" style="margin-right:0px;">
			<li class="dropdown active">
				<a class="dropdown-toggle active" data-toggle="dropdown" href="###">
					<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user in">
					<li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
				</ul>
			</li>
		</ul>

		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse active">
				<ul class="nav in metismenu" id="side-menu">
					<li>
						<a href="{{ url('/admin/article') }}"><i class="fa fa-edit fa-fw"></i> 文章管理</a>
					</li>
					<li>
						<a href="{{ URL('admin/category') }}"><i class="fa fa-dashboard fa-fw"></i> 分类管理</a>
					</li>
					<li>
						<a href="{{ url('/admin/customer' )}}"><i class="fa fa-user fa-fw"></i> 用户管理</a>
					</li>
					<li>
						<a href="{{ url('/admin/picture' )}}"><i class="fa fa-picture-o fa-fw"></i> 图片库</a>
					</li>
					<li>
						<a href="{{ url('/admin/setting' )}}"><i class="fa fa-gear fa-fw"></i> 基础设置</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="page-wrapper">
	    @yield('content')
	</div>

	<!-- Scripts -->
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
