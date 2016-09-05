@extends('app')
@section('content')
@include('editor::head')
<div class="row">
    <div class="col-lg-8">
        <h3 class="admin-page-header">{{ $article->title }}</h3>
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
		  
			<form action="{{ URL('admin/article/'.$article->id) }}" method="POST">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label>标题：</label>
					<input type="text" name="title" class="form-control" required="required" value="{{ $article->title }}">
				</div>  
				<div class="form-group">
					<label>关键字：</label>
					<input type="text" name="slug" class="form-control" required="required" value="{{ $article->slug }}">
				</div> 	
				<div class="form-group">
					<label>分类：</label>
					<select name="cat_id" class="form-control" required="required">
						<option value=""></option>
						@foreach($category as $cate)
						<option value="{{$cate->id}}" @if($article->cat_id == $cate->id) selected="selected" @endif>{{ $cate->title}}</option>
						@endforeach
					</select>
				</div> 	
				<div class="form-group">
					<label>短描述：</label>
					<textarea class="form-control" rows="3" name="summary">{{ $article->summary }}</textarea>
				</div>	
				<div class="form-group">
					<label>文章内容：</label>
					<div class="editor">
						<textarea id="myEditor" name="body">{!! $article->body !!}</textarea>
					</div>
				</div>					
				<button type="submit" class="admin-btn btn btn-success">提交文章</button>
			</form>
		</div>
	</div>
</div>
@endsection