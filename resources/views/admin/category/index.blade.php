@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="admin-page-header">分类管理<a href="{{ URL('admin/category/create') }}" class="btn btn-success" style="margin-left:10px;">新增分类</a></h3>
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
							 <th class="col-sm-8">标题</th>
							 <th class="center col-sm-1">文章数</th>
							 <th class="center col-sm-1">创建时间</th>
							 <th class="center col-sm-1">操作</th>
						</tr>
					</thead>
					<tbody> 
					@foreach ($category as $cate)							
						<tr>
						    <td>{{ $cate->id }}</td>
							<td><a class="title" href="{{ URL('admin/category/'.$cate->id.'/edit') }}">{{ $cate->title }}</a></td>
							<td class="center">{{ getCategoryArticleNumber($cate->id) }}</td>
							<td><span class="updated_at">{{ $cate->created_at }}</span></td>
							<td class="center">
							    <a href="{{ URL('admin/category/'.$cate->id.'/edit') }}" class="btn btn-success"><i class="fa fa-pencil fa-fw"></i>编辑</a>
								<form action="{{ URL('admin/category/'.$cate->id) }}" method="POST" style="display: inline;">
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
    </div>
</div>
@endsection