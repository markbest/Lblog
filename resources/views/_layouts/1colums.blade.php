<!DOCTYPE html>
<html lang="zh-CN">
	@include('parts.head')
	<body>
		<div class="top_content">
			@include('parts.top')
		</div>
		<div class="container" style="margin-top:20px;">
			<div class="main_container">
		    	@yield('content')
			</div>
		</div>
		@include('parts.footer')
	</body>
</html>