<nav class="navbar navbar-default container">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#as-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand logo" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" height="80px" /></a>
		</div>

		<div class="collapse navbar-collapse" id="as-example-navbar-collapse-1">
			@foreach($Categories as $cate)
			<ul class="nav navbar-nav">
				<li><a href="{{ URL('category/'. $cate->title) }}">{{ $cate->title}}</a></li>
			</ul>
			@endforeach
			<ul class="nav navbar-nav navbar-right" style="margin-right:0px;">
			    <li class="customer-login"><a href="{{ url('picture') }}">图片墙</a></li>
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