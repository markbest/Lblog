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

<!-- 多说评论框 start -->
<div class="ds-thread" data-thread-key="{{ $article->id }}" data-title="{{ $article->title }}" data-url="{{ asset(Request::getRequestUri()) }}"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
	var duoshuoQuery = {short_name:"mark-here"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0]
		|| document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
</script>
<!-- 多说公共JS代码 end -->
@endsection