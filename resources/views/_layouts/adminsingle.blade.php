<!DOCTYPE html>
<html lang="en">
@include('parts.admin.head');
<body class="admin_body">

	@yield('content')

	<!-- Scripts -->
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
