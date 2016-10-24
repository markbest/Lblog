@extends('_layouts.1colums')
@section('content')
<div class="col-lg-12 register_customer">
    <div class="col-lg-8">
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

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label">邮箱：</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" required="required" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">密码：</label>
						<div class="col-md-6">
							<input type="password" class="form-control" required="required" name="password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">登录</button>
							<a class="btn btn-link" href="{{ url('/password/email') }}">忘记密码?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
@endsection