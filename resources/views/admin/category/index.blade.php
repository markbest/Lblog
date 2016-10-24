@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
		<div class="admin-page-header">
			<div class="col-sm-4">
				<i class="fa fa-home fa-fw"></i>分类管理
			</div>
			<div class="col-sm-8 align-right">
				<button type="button" data-toggle="modal" data-target="#add_category" class="admin-btn-head btn btn-primary">
					<i class="fa fa-plus-circle fa-fw"></i>新增分类
				</button>
			</div>
		</div>
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
							<td>{{ $cate->title }}</td>
							<td class="center">{{ getCategoryArticleNumber($cate->id) }}</td>
							<td><span class="updated_at">{{ $cate->created_at }}</span></td>
							<td class="center">
								<button type="button" data-toggle="modal" data-target="#edit_category_{{ $cate->id }}" class="admin-btn btn btn-success">
									<i class="fa fa-pencil fa-fw"></i>编辑</a>
								</button>
								<form action="{{ URL('admin/category/'.$cate->id) }}" method="POST" style="display:inline;">
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="button" class="btn btn-danger del_btn"><i class="fa fa-trash fa-fw"></i>删除</button>
								</form>
							</td>
						</tr>
						<div class="modal fade" id="edit_category_{{ $cate->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title" id="myModalLabel">编辑分类</h4>
									</div>
									<form action="{{ URL('admin/category/'.$cate->id) }}" method="POST">
										<input name="_method" type="hidden" value="PUT">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<div class="modal-body">
											<div class="form-group">
												<label>分类名称：</label>
												<input type="text" name="title" class="form-control" required="required" value="{{ $cate->title }}">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="admin-btn btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i>关闭</button>
											<button type="submit" class="admin-btn btn btn-primary"><i class="fa fa-floppy-o"></i>保存</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					@endforeach
					</tbody>
				</table>
				<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h4 class="modal-title" id="myModalLabel">新增分类</h4>
							</div>
							<form action="{{ url('admin/category')}}" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="modal-body">
									<div class="form-group">
										<label>分类名称：</label>
										<input type="text" name="title" class="form-control" required="required" value="">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="admin-btn btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i>关闭</button>
									<button type="submit" class="admin-btn btn btn-primary"><i class="fa fa-floppy-o"></i>保存</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection