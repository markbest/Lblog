@extends('_layouts.default')
@section('title')
	{{ $category->title }} - mark-here.com
@endsection
@section('content')
<div class="view">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">主页</a>
		<li class="active">{{ $category->title }}</li>
	</ul>
</div>
<div id="category_article_list">
	@foreach ($articles as $article)
	<div class="list_content">
		<div class="title">
			<a href="{{ URL('article/'.$article->id) }}">
				<h4>{{ $article->title }}</h4>
			</a>
		</div>
		<div class="short_content">
			<p>{{ $article->summary }}...</p>
		</div>
		<div class="article_addition">
			<span>{{ shortDate($article->created_at) }}</span>
			<span class="views_count"><a href="{{ URL('article/'.$article->id) }}">阅读</a>({{ $article->views}})</span>
		</div>
	</div>
  	@endforeach
	<div class="front_page page_html">
		<div class="col-sm-6">
			<div class="pages_title">
				{{ getPageHtml($articles->perPage(),$articles->currentPage(),$articles->count(),$articles->total()) }}
			</div>
		</div>
		<div class="col-sm-6">
			<div class="pages_content">
				{!! $articles->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection