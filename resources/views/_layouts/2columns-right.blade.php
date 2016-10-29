<!DOCTYPE html>
<html lang="zh-CN">
	@include('parts.head')
	<body>
		<div class="top_content">
			@include('parts.top')
		</div>
		<div class="container">
			<div class="main_container">
				<div class="left_content col-md-8">
			       @yield('content')
				</div>
				<div class="right_content col-md-4">
				   @include('parts.sidebar')
				</div>
			</div>
		</div>
		@include('parts.footer')
	</body>
</html>