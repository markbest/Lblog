@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="admin-page-header"><i class="fa fa-home fa-fw"></i>用户管理</h3>
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
							 <th class="center col-sm-7">姓名</th>
							 <th class="center col-sm-2">邮箱</th>
							 <th class="center col-sm-1">创建时间</th>
							 <th class="center col-sm-1">操作</th>
						</tr>
					</thead>
					<tbody> 
					@foreach ($customers as $customer)							
						<tr>
						    <td>{{ $customer->id }}</td>
							<td class="center">{{ $customer->name }}</td>
							<td class="center">{{ $customer->email }}</td>
							<td class="center">{{ $customer->created_at }}</td>
							<td class="center">
							     <a href="{{ URL('admin/customer/'.$customer->id.'/edit') }}" class="btn btn-success"><i class="fa fa-pencil fa-fw"></i>编辑</a>
								 <form action="{{ URL('admin/customer/'.$customer->id) }}" method="POST" style="display: inline;">
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