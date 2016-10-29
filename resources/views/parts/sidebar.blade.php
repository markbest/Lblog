<div class="panel panel-default newest_sort">
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

<div class="panel panel-default views_sort">
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