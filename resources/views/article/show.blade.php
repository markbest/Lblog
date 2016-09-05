@extends('_layouts.default')
@section('title')
   {{ $article->title }} - mark-here.com
@endsection
@section('content')
<div class="view">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">主页</a>
		<li><a href="{{ URL('category/'.$article->category_name)}}">{{ $article->category_name }}</a></li>
		<li class="active">{{ $article->title }}</li>
	</ul>
</div>
<div class="article_title">
	<div class="col-sm-8"><h3>{{ $article->title }}</h3></div>
	<div class="col-sm-4">
		<div class="addition_info">
			<div class="other">
				<span class="date">{{ shortDate($article->created_at) }}</span>
				<span class="views_count">{{ $article->views}}人阅读</span>
				<span class="review"><a href="#new">评论</a>({{ $article->reviews}})</span>
			</div>
		</div>
	</div>
</div>
<div id="content" class="article_content" style="padding: 5px;">
	<p>{!! $article->body !!}</p>
</div>
<div id="comments" style="margin-top:50px;padding:5px;">
    @if(count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
            @endforeach
        </ul>
	</div>
    @endif
    
	<div class="conmments">
	@foreach ($comment as $comment)
		<div class="one" style="border-top: solid 20px #efefef; padding: 5px 20px;">
			<div class="nickname" data="{{ $comment->nickname }}">
				<h6 style="float:left;">{{ $comment->nickname }}</h6>
				<h6 style="float:right;">{{ $comment->created_at }}</h6>
			</div>
			<div class="content" style="clear:both;">
	            <p style="padding: 10px;">
	              {{ $comment->content }}
	            </p>
			</div>
			<div class="reply" style="text-align: right; padding: 5px; display: none;">
				<a href="#new" onclick="reply(this);">Reply</a>
			</div>
        </div>
	@endforeach
	</div>
</div>
<div id="new">
	<form action="{{ URL('comment/store') }}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        @if (checklogin())
        <div class="form-group" style="display:none;">
			<label>昵称</label>
			<input type="text" name="nickname" class="form-control" style="width: 250px;" required="required" value="{{ getCustomer()->name }}">
        </div>
        <div class="form-group" style="display:none;">
			<label>邮箱</label>
			<input type="email" name="email" class="form-control" style="width: 250px;" value="{{ getCustomer()->email }}">
        </div>
        <div class="form-group" style="display:none;">
			<label>网站</label>
			<input type="text" name="website" class="form-control" style="width: 250px;">
        </div>
        <div class="form-group">
			<label>内容</label>
			<textarea name="content" id="newFormContent" class="form-control" rows="10" required="required"></textarea>
        </div>
        <button type="submit" style="width:100px" class="btn btn-lg btn-success col-lg-12">提交</button>
		@endif
	</form>
</div>
<script>
	function reply(a) {
		var nickname = a.parentNode.parentNode.firstChild.nextSibling.getAttribute('data');
		var textArea = document.getElementById('newFormContent');
		textArea.innerHTML = '@'+nickname+' ';
	}
</script>
@endsection