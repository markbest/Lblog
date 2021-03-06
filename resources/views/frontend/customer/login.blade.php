@extends('_layouts.pop')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-logo">
					<img src="{{ asset('images/logo.png') }}" />
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">用户登录</div>
					<div class="panel-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form role="form" method="POST" action="{{ url('/customer/login') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<input type="email"  placeholder="E-mail" class="form-control" name="email" required="required" autofocus value="{{ old('email') }}">
							</div>
							<div class="form-group">
								<input type="password" placeholder="Password" class="form-control" required="required" name="password">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">登录</button>
								<a href="{{ asset('customer/register') }}"><button type="button" class="btn btn-primary">注册</button></a>
								<a class="btn btn-link" href="{{ url('/') }}">返回首页</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection