<div class="panel panel-default newest_sort">
    <div class="panel-heading">最新文章</div>
    <ul>
        @foreach ($NewestArticles as $article)
		<li>
		    <a href="{{ URL('article/'.$article->id) }}" title="{{ $article->title }}">
				{{ $article->title }}
		    </a>
		</li>
  	    @endforeach
    </ul>
</div>

<div class="panel panel-default views_sort">
    <div class="panel-heading">阅读排行</div>
    <ul>
        @foreach ($MostviewArticles as $article)
		<li>
		    <a href="{{ URL('article/'.$article->id) }}" title="{{ $article->title }}">
				{{ $article->title }}
		    </a>
		    <label>({{ $article->views }})</label>
		</li>
  	    @endforeach
    </ul>
</div>

<script type="text/javascript">
$(document).ready(function(){
    if(!$('#myCanvas').tagcanvas({
		textColour : '#000000',
		outlineThickness : 1,
		maxSpeed : 0.03,
		depth : 0.95,
		wheelZoom : false
    })){
        $('.tags_cloude').hide();
    }
});
</script>
<div class="panel panel-default tags_cloude">
    <canvas style="max-width:252px;" height="250" id="myCanvas">
	    <ul>
		@foreach (getAllTags() as $tag)
		   <li><a href="{{ URL('article/'.$tag['id']) }}" title="{{ $tag['name'] }}">{{ $tag['name'] }}</a></li>
		@endforeach
		</ul>
	</canvas>
</div>