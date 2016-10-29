<!DOCTYPE html>
<html lang="zh-CN">
@include('parts.head')
<body>
	<div class="login_single_body">
		<div class="container">
			<div class="main_container">
				@yield('content')
			</div>
		</div>
		@include('parts.footer')
	</div>
</body>
</html>
