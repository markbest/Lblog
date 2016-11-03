@extends('app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="admin-page-header">
                <div class="col-sm-4"><i class="fa fa-home fa-fw"></i>资料管理</div>
                <div class="col-sm-8 align-right">
                    <button class="admin-btn-head btn btn-primary" data-toggle="modal" data-target="#add_file">
                        <i class="fa fa-plus-circle fa-fw"></i>上传资料
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
                            <th class="col-sm-2">标题</th>
                            <th class="col-sm-2">名称</th>
                            <th class="col-sm-1">大小</th>
                            <th class="col-sm-1">分类</th>
                            <th class="col-sm-1">类型</th>
                            <th class="col-sm-1">创建时间</th>
                            <th class="col-sm-1"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->title }}</td>
                                <td>{{ $file->name }}</td>
                                <td>{{ getFileSizeShow($file->size) }}</td>
                                <td>{{ $file->category_name }}</td>
                                <td>{{ $file->type }}</td>
                                <td>{{ $file->created_at }}</td>
                                <td class="center">
                                    <button type="button" data-toggle="modal" data-target="#edit_file_{{ $file->id }}" class="admin-btn btn btn-success">
                                        <i class="fa fa-pencil fa-fw"></i>编辑</a>
                                    </button>
                                    <form action="{{ URL('admin/file/'.$file->id) }}" method="POST" style="display: inline;">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="button" class="admin-btn btn btn-danger del_btn"><i class="fa fa-trash fa-fw"></i>删除</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="edit_file_{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">编辑资料</h4>
                                        </div>
                                        <form action="{{ URL('admin/file/'.$file->id) }}" method="POST">
                                            <input name="_method" type="hidden" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>资料名称：</label>
                                                    <input type="text" name="title" class="form-control" required="required" value="{{ $file->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>分类归属：</label>
                                                    {!! getAllCategorySelectList($file->cat_id) !!}
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
                    <div class="modal fade" id="add_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">上传文件</h4>
                                </div>
                                <div class="col-md-12">
                                    <div id="drag-and-drop-zone" class="uploader">
                                        <div>Drag &amp; Drop Files Here</div>
                                        <div class="or">-or-</div>
                                        <div class="browser">
                                            <label>
                                                <span>Click to open the file Browser</span>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <input type="file" name="files" accept="*" multiple="multiple" title='Click to add files'>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="display:none;">
                                        <div class="panel-heading"><h3 class="panel-title">Debug</h3></div>
                                        <div class="panel-body panel-debug">
                                            <ul id="debug-container"></ul>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h3 class="panel-title">Uploads</h3></div>
                                        <div class="panel-body panel-files" id='files-container'>
                                            <span class="note-container">No Files have been selected/droped yet...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page_html">
                <div class="col-sm-6">
                    <div class="pages_title">
                        {{ getPageHtml($files->perPage(),$files->currentPage(),$files->count(),$files->total()) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="pages_content">
                        {!! $files->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/uploader.css') }}" />
    <script src="{{ asset('js/demo-preview.js') }}"></script>
    <script src="{{ asset('js/dmuploader.js') }}"></script>
    <script>
        $(function(){
            $('#drag-and-drop-zone').dmUploader({
                url: '{{ URL("admin/file/upload")}}',
                dataType: 'json',
                extraData:{'_token': $('input[name="_token"]').val()},
                allowedTypes: '*',
                onInit: function(){
                    $.danidemo.addLog('#debug-container', 'default', 'Plugin initialized correctly');
                },
                onBeforeUpload: function(id){
                    $.danidemo.addLog('#debug-container', 'default', 'Starting the upload of #' + id);
                    $.danidemo.updateFileStatus(id, 'default', 'Uploading...');
                },
                onNewFile: function(id, file){
                    $.danidemo.addFile('#files-container', id, file);
                    $('#uploader-files').find('.uploader-image-preview').remove();
                },
                onComplete: function(){
                    $.danidemo.addLog('#debug-container', 'default', 'All pending tranfers completed');
                    location.reload();
                },
                onUploadProgress: function(id, percent){
                    var percentStr = percent + '%';
                    $.danidemo.updateFileProgress(id, percentStr);
                },
                onUploadSuccess: function(id, data){
                    $.danidemo.addLog('#debug-container', 'success', 'Upload of file #' + id + ' completed');
                    $.danidemo.addLog('#debug-container', 'info', 'Server Response for file #' + id + ': ' + JSON.stringify(data));
                    $.danidemo.updateFileStatus(id, 'success', 'Upload Complete');
                    $.danidemo.updateFileProgress(id, '100%');
                },
                onUploadError: function(id, message){
                    $.danidemo.updateFileStatus(id, 'error', message);
                    $.danidemo.addLog('#debug-container', 'error', 'Failed to Upload file #' + id + ': ' + message);
                },
                onFileTypeError: function(file){
                    $.danidemo.addLog('#debug-container', 'error', 'File \'' + file.name + '\' cannot be added: must be an image');
                },
                onFileSizeError: function(file){
                    $.danidemo.addLog('#debug-container', 'error', 'File \'' + file.name + '\' cannot be added: size excess limit');
                },
                onFallbackMode: function(message){
                    $.danidemo.addLog('#debug-container', 'info', 'Browser not supported(do something else here!): ' + message);
                }
            });
        });
    </script>
@endsection