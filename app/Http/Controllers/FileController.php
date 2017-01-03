<?php namespace App\Http\Controllers;

use App\Repositories\FileRepositoryEloquent;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    private $file_repo;

    public function __construct(FileRepositoryEloquent $file)
    {
        $this->file_repo = $file;
    }

    public function show(){
        $files = $this->file_repo->paginate('10');
        return view('frontend.file', ['files' => $files]);
    }

    public function download($id){
        $file = $this->file_repo->find($id);
        $download_file = storage_path('app/public/file'). DIRECTORY_SEPARATOR . $file->link;

        $headers = array(
            'Content-Type: application/' . $file->type,
        );

        return Response::download($download_file, $file->name, $headers);
    }
}