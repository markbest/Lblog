@extends('_layouts.2columns-right')
@section('title')
	{{ $title }} - markbest.site
@endsection
@section('content')
<div id="category_article_list">
	@foreach ($articles as $article)
	<div class="list_content well">
		<i class="fa fa-bookmark fa-3x article-stick visible-md visible-lg"></i>
		<div class="data-article">
			<span class="month">{{ date('m', strtotime($article->created_at)) }}月</span>
			<span class="day">{{ date('d', strtotime($article->created_at)) }}</span>
		</div>
		<div class="title-article">
			<h1>
				<a title="{{ $article->title }}" href="{{ URL('article/'.$article->id) }}">{{ $article->title }}</a>
			</h1>
		</div>
		<div class="tag-article">
			@if($article->slug)
				@foreach( getArticleTagsList($article->slug) as $tag)
				<span class="label"><i class="fa fa-tags"></i> {{ $tag }}</span>
				@endforeach
			@endif
			<span class="label"><i class="fa fa-user"></i> mark</span>
			<span class="label"><i class="fa fa-eye"></i> {{ $article->views }}</span>
		</div>
		<div class="short_content">
			<p>{{ $article->summary }}</p>
		</div>
		<div class="article_addition">
			<a class="btn btn-danger pull-right read-more" href="{{ URL('article/'.$article->id) }}" title="详细阅读 {{ $article->title }}">
				阅读全文 <span class="badge">{{ $article->views }}</span>
			</a>
		</div>
	</div>
  	@endforeach

	<div class="front_page page_html">
		<div class="col-sm-4">
			<div class="pages_title">
				{{ getPageHtml($articles->perPage(),$articles->currentPage(),$articles->count(),$articles->total()) }}
			</div>
		</div>
		<div class="col-sm-8">
			<div class="pages_content">
				{!! $articles->render() !!}
			</div>
		</div>
	</div>
</div>
@endsection