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
        $file_link = $file->link;
        $file_type_array = explode('.', $file_link);

        $file_type = end($file_type_array);
        $file_name = $file->name;
        $download_file = storage_path('app/public/file'). DIRECTORY_SEPARATOR . $file_link;

        $headers = array(
            'Content-Type: application/'.$file_type,
        );

        return Response::download($download_file, $file_name, $headers);
    }
}