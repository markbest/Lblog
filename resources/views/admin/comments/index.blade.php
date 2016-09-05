@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="admin-page-header">评论管理</h3>
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
							 <th class="col-sm-4">内容</th>
							 <th class="center col-sm-1">用户</th>
							 <th class="center col-sm-1">邮箱</th>
							 <th class="center col-sm-4">文章</th>
							 <th class="center col-sm-1">操作</th>
						</tr>
					</thead>
					<tbody> 
					@foreach ($comments as $comment)								
						<tr>
						    <td>{{ $comment->id }}</td>
							<td>{{ $comment->content }}</td>
							<td class="center">{{ $comment->nickname }}</td>
							<td class="center">{{ $comment->email }}</td>
							<td class="center"> 
								<a href="{{ URL('article/'.$comment->article_id) }}" target="_blank">
								  {{ App\Article::find($comment->article_id)->title }}
								</a>
							</td>
							<td class="center">
							     <a href="{{ URL('admin/comments/'.$comment->id.'/edit') }}" class="btn btn-success"><i class="fa fa-pencil fa-fw"></i>编辑</a>
								 <form action="{{ URL('admin/comments/'.$comment->id) }}" method="POST" style="display: inline;">
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="submit" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i>删除</button>
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