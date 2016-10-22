@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="admin-page-header"><i class="fa fa-home fa-fw"></i>用户管理 / {{ $customer->name }}</h3>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
		<div class="admin-panel-body">
		
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
		  
			<form action="{{ url('admin/customer/'.$customer->id) }}" method="POST">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" value="{{ $customer->id }}">
				<div class="form-group">
					<label>姓名：</label>
					<input type="text" name="name" class="form-control" required="required" value="{{ $customer->name }}">
				</div> 
				<div class="form-group">
					<label>新密码：</label>
					<input type="password" name="password" class="form-control" required="required" value="">
				</div>				
				<button class="admin-btn btn btn-success">提交用户</button>
			</form>
			
		</div>
	</div>
</div>
@endsection