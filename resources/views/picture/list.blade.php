@extends('_layouts.1colums')

@section('title')
 	图片墙 - mark-here.com
@endsection

@section('content')
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