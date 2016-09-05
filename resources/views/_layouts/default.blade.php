<!DOCTYPE html>
<html lang="zh-CN">
	@include('parts.head')
	<body>
		@include('parts.header')
		<div class="container" style="margin-top: 20px;">
			<div class="main_container">
				<div class="left_content col-md-9">
			       @yield('content')
				</div>
				<div class="right_content col-md-3">
				   @include('parts.sidebar')
				</div>
			</div>
		</div>
		@include('parts.footer')
	</body>
</html>