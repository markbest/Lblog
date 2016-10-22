@extends('app')
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
		<div class="row">
			<div class="col-sm-12">
				<ul class="picture_wall">
				   @foreach ($pictures as $picture)
					  <li class="picture_wall_list">
						  <form name="pic_info" action="{{ URL('admin/picture/'.$picture->id)}}" method="post">
							  <input name="_method" type="hidden" value="PUT">
							  <input type="hidden" name="_token" value="{{ csrf_token() }}">
							  <a rel="group" href="{{ $picture->img_url }}" title="{{ $picture->note }}"><img src="{{ $picture->img_url }}" /></a>
							  Input Picture Note :<textarea name="note" style="height:54px;width:200px;border-color:#ffffff;">{{ $picture->note }}</textarea>
							  <input style="margin:8px 5px 0px 0px;" type="checkbox" value="1" name="delete" />delete <button style="padding:5px 8px;float:right;" class="admin-btn btn btn-info">Save</button>
						  </form>
					  </li>
				   @endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endsection




