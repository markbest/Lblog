<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mark的私人博客</title>

	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<script src="{{ asset('/js/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
</head>
<body class="admin_single_body">
	@yield('content')

	<!-- Scripts -->
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
