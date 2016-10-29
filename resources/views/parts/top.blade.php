<nav class="navbar navbar-default container">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#as-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand logo" title="{{ getConfig('web_title') }}" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" /></a>
		</div>

		<div class="collapse navbar-collapse" id="as-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="{{ active_class(if_uri_pattern(['/']), 'active', '') }}">
					<a href="{{ url('') }}"><i class="fa fa-home"></i> 首页</a>
				</li>
				@foreach($Categories as $cate)
				<li class="{{ active_class(if_uri_pattern(['category/'.$cate['title']]), 'active', '') }}">
					@if(count($cate['child']))
						<a data-toggle="dropdown" href="#">{{ $cate['title'] }} <span class="caret"></span></a>
						<ul class="dropdown-menu">
							@foreach($cate['child'] as $child)
							<li><a href="{{ url('category/'. $child['title']) }}">{{ $child['title'] }}</a></li>
							@endforeach
						</ul>
					@else
						<a href="{{ url('category/'. $cate['title']) }}">{{ $cate['title'] }}</a>
					@endif
				</li>
				@endforeach
			</ul>
			<ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
				<li class="customer-login"><a href="{{ url('customer/works') }}">作品</a></li>
			    @if (!checklogin())
					<li class="customer-login"><a href="{{ url('customer/login') }}">登录</a></li>
					<li class="customer-register"><a href="{{ url('customer/register') }}">注册</a></li>
				@else
					<li class="dropdown">
						<a href="###" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="customer_small_icon" width="25px" height="25px" src="{{ getCustomerIcon() }}" /> {{ getCustomer()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						    <li><a href="{{ url('customer/home') }}">我的信息</a></li>
							<li><a href="{{ url('customer/logout') }}">退出登录</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>