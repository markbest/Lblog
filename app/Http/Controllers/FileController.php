<?php namespace App\Http\Controllers;

use App\File;
use DB;
use Redirect, Input;
use Illuminate\Support\Facades\Response;

class FileController extends Controller {
    public function show(){
        $files = File::paginate('10');
        return view('frontend.file')->withFiles($files);
    }

    public function download($id){
        $file = File::find($id);
        $file_link = $file->link;
        $file_type_array = explode('.', $file_link);

        $file_type = end($file_type_array);
        $file_name = $file->name;
        $download_file = public_path(). '/'. $file_link;

        $headers = array(
            'Content-Type: application/'.$file_type,
        );

        return Response::download($download_file, $file_name, $headers);
    }
}