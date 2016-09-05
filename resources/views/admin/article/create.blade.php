@extends('app')
@section('content')
@include('editor::head')
<div class="row">
    <div class="col-lg-8">
        <h3 class="admin-page-header">新建文章</h3>
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
		  
			<form action="{{ URL('admin/article/') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label>标题：</label>
					<input type="text" name="title" class="form-control" required="required">
				</div>  
				<div class="form-group">
					<label>关键字：</label>
					<input type="text" name="slug" class="form-control" required="required">
				</div> 	
				<div class="form-group">
					<label>分类：</label>
					<select name="cat_id" class="form-control" required="required">
						<option value=""></option>
						@foreach($category as $cate)
						<option value="{{$cate->id}}">{{ $cate->title}}</option>
						@endforeach
					</select>
				</div> 	
				<div class="form-group">
					<label>短描述：</label>
					<textarea class="form-control" rows="3" name="summary"></textarea>
				</div>	
				<div class="form-group">
					<label>文章内容：</label>
					<div class="editor">
						<textarea id="myEditor" name="body"></textarea>
					</div>
				</div>					
				<button type="submit" class="admin-btn btn btn-success">提交文章</button>
			</form>
		</div>
    </div>
</div>
@endsection