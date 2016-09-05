@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <h3 class="admin-page-header">编辑评论</h3>
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
		
			<form action="{{ url('admin/comments/'.$comment->id) }}" method="POST">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="article_id" value="{{ $comment->article_id }}">
				
				<div class="form-group">
					<label>用户名：</label>
					<input type="text" name="nickname" class="form-control" required="required" value="{{ $comment->nickname }}">
				</div>
				<div class="form-group">
					<label>邮箱：</label>
					<input type="text" name="email" class="form-control" required="required" value="{{ $comment->email }}">
				</div>
				<div class="form-group">
					<label>网站：</label>
					<input type="text" name="website" class="form-control" required="required" value="{{ $comment->website }}">
				</div>
				<div class="form-group">
					<label>内容：</label>
					<textarea name="content" rows="3" class="form-control" required="required">{{ $comment->content }}</textarea>
				</div>
				<button class="admin-btn btn btn-success">提交评论</button>
			</form>
		</div>
	</div>
</div>
@endsection