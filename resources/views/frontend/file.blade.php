@extends('_layouts.2columns-right')
@section('title')
    {{ $title }} - mark-here.com
@endsection
@section('content')
    <div class="file-list-container">
        <ul>
            @foreach($files as $file)
            <li>
                <h3>{{ $file->title }}</h3>
                <div class="file-info">
                    <a href="{{ URL('file/download/'.$file->id) }}">{{ $file->name }}</a><br>
                    <span>{{ $file->created_at }}, {{ getFileSizeShow($file->size) }}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="front_page page_html">
        <div class="col-sm-4">
            <div class="pages_title">
                {{ getPageHtml($files->perPage(),$files->currentPage(),$files->count(),$files->total()) }}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="pages_content">
                {!! $files->render() !!}
            </div>
        </div>
    </div>
@endsection