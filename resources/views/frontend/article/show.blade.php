@extends('_layouts.2columns-right')
@section('title')
   {{ $article->title }} - mark-here.com
@endsection
@section('content')
<div class="article-content">
	<div class="view">
		<ul class="breadcrumb">
			<li><i class="fa fa-home fa-fw"></i> <a href="{{ url('/') }}">主页</a>
			<li><a href="{{ URL('category/'.$article->category_name)}}">{{ $article->category_name }}</a></li>
			<li class="active">{{ $article->title }}</li>
		</ul>
	</div>
	<div class="title-article">
		<h1>
			<a title="{{ $article->title }}" href="{{ URL('article/'.$article->id) }}">{{ $article->title }}</a>
		</h1>
	</div>
	<div class="tag-article">
		<span class="label"><i class="fa fa-tags"></i> {{ date('m-d', strtotime($article->created_at)) }}</span>
		<span class="label"><i class="fa fa-user"></i> mark</span>
		<span class="label"><i class="fa fa-eye"></i> {{ $article->views }}</span>
	</div>
	<div id="content">
		<p>{!! $article->body !!}</p>
	</div>
</div>
@endsection