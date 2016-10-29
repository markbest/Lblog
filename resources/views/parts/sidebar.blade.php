<div class="panel panel-default search-bar">
	<form class="form-inline clearfix" method="get" id="searchform" action="{{ asset('search') }}">
		<input class="form-control" type="text" name="s" value="{{ Request::get('s') }}" placeholder="搜索...">
		<button type="submit" class="btn btn-danger btn-small"><i class="fa fa-search"></i></button>
	</form>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-leaf"></i> 最新文章</div>
    <ul class="list-group list-group-flush">
        @foreach ($NewestArticles as $article)
		<li class="list-group-item">
		    <a href="{{ URL('article/'.$article->id) }}" title="{{ $article->title }}">
				{{ $article->title }}
		    </a>
		</li>
  	    @endforeach
    </ul>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-fire"></i> 最热文章</div>
    <ul class="list-group list-group-flush">
        @foreach ($MostviewArticles as $article)
		<li class="list-group-item">
		    <a href="{{ URL('article/'.$article->id) }}" title="{{ $article->title }}">
				{{ $article->title }}
		    </a>
		    <label class="badge">{{ $article->views }}</label>
		</li>
  	    @endforeach
    </ul>
</div>