@extends('_layouts.pop')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-logo">
					<img src="{{ asset('images/logo.png') }}" />
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">用户注册</div>
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

						<form role="form" method="POST" action="{{ url('/customer/register') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<input type="text" placeholder="昵称" class="form-control" name="name" required="required" value="{{ old('name') }}">
							</div>
							<div class="form-group">
								<input type="email" placeholder="邮箱" class="form-control" name="email" required="required" value="{{ old('email') }}">
							</div>

							<div class="form-group">
								<input type="password" placeholder="密码" class="form-control" required="required" name="password">
							</div>

							<div class="form-group">
								<input type="password" placeholder="确认密码" class="form-control" required="required" name="password_confirmation">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">注册</button>
								<a class="btn btn-link" href="{{ url('/') }}">返回首页</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection