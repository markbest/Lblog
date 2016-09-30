@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="admin-page-header row">
            <div class="col-sm-10">文章管理<a href="{{ URL('admin/article/create') }}" class="btn btn-success" style="margin-left:10px;">新增文章</a></div>
            <div class="col-sm-2 add_list_button right">
	            <form action="{{ URL('admin/article') }}" method="GET" style="display: inline;">
					<div class="input-group custom-search-form">
						<input type="text" class="form-control" name="keywords" placeholder="Search..." value="{{ Request::get('keywords') }}" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
				
            </div>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-striped">
					<thead>
						<tr>
						     <th class="col-sm-1">#</th>
							 <th class="col-sm-5">标题</th>
							 <th class="col-sm-2">标签</th>
							 <th class="center col-sm-1">分类</th>
							 <th class="center col-sm-1">创建时间</th>
							 <th class="center col-sm-1">浏览量</th>
							 <th class="center col-sm-1">操作</th>
						</tr>
					</thead>
					<tbody> 
					@foreach ($articles as $article)									
						<tr>
						    <td>{{ $article->id }}</td>
							<td><a class="title" href="{{ URL('admin/article/'.$article->id.'/edit') }}">{!! getMatchName(Request::get('keywords'),$article->title) !!}</a></td>
							<td>{{ $article->slug }}</td>
							<td class="center"><a class="category" href="{{ URL('category/'.$article->category_name) }}" target="_blank">{{ $article->category_name }}</a></td>
							<td class="center"><span class="updated_at">{{ $article->created_at }}</span></td>
							<td class="center"><span class="updated_at">{{ $article->views }}</span></td>
							<td class="center">
							     <a href="{{ URL('admin/article/'.$article->id.'/edit') }}" class="btn btn-success"><i class="fa fa-pencil fa-fw"></i>编辑</a>
								 <form action="{{ URL('admin/article/'.$article->id) }}" method="POST" style="display: inline;">
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="button" class="btn btn-danger del_btn"><i class="fa fa-trash fa-fw"></i>删除</button>
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="page_html">
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
</div>
@endsection