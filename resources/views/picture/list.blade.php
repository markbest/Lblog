@extends('_layouts.1colums')

@section('title')
 	图片墙 - mark-here.com
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}" rel="stylesheet" />
<script type="text/javascript" src="{{ asset('js/jquery.fancybox-1.3.1.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.masonry.min.js') }}"></script>
<script type="text/javascript">
	$(function(){
		$("a[rel=group]").fancybox({
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic',
			'titlePosition' : 'inside'
		});
	});
	$(document).ready(function(){
		var $container = $('.picture_wall');	
		$container.imagesLoaded(function(){
			$container.masonry({
				itemSelector: '.picture_wall_list',
				columnWidth: 5 //每两列之间的间隙为5像素
			});
		});
	});
</script>
<div class="row">
    <div class="col-lg-12">
		<div class="row front-page">
			<div class="col-sm-12">
				<ul class="picture_wall">
				   @foreach ($pictures as $picture)
					  <li class="picture_wall_list">
					  	  <a rel="group" href="{{ $picture->img_url }}" title="{{ $picture->note }}"><img src="{{ $picture->img_url }}" /></a>
					  </li>
				   @endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection