@extends('_layouts.adminsingle')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-logo">
				<img src="{{ asset('images/logo.png') }}" height="90px"/>
			</div>
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Sign In</h3>
				</div>
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
					<form role="form" method="POST" action="{{ url('/auth/login') }}">
					    <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" required="required" type="email" autofocus value="{{ old('email') }}">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" required="required" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
									
								</label>
							</div>
							<button class="btn btn-success btn-block">Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
