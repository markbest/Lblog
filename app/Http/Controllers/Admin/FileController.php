<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FileRepositoryEloquent;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Redirect, Input;

class FileController extends Controller
{
    private $file_repo;

    public function __construct(FileRepositoryEloquent $file)
    {
        $this->file_repo = $file;
    }

    public function index(){
        $files = $this->file_repo->getAllWithCategory('30');
        return view('admin.file', ['files' => $files]);
    }

    public function upload(){
        $result = array();
        try{
            $file = Input::file('file');
            if($file->isValid()){
                $newName =  date('Y'). DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR .md5(date('ymdhis').$file->getClientOriginalName()).".".$file->getClientOriginalExtension();
                Storage::disk('file')->put($newName, file_get_contents($file->getRealPath()));

                $status = 'ok';
                $message = 'success upload';

                $this->file_repo->create([
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getClientSize(),
                    'link' => $newName,
                    'type' => $file->getClientOriginalExtension(),
                    'created_at' => date('Y-m-d h:i:s', time())
                ]);
            }else{
                $message = 'Some error occurs when uploading file';
                $status = 'nok';
            }
        }catch (\Exception $e){
            $message = $e->getMessage();
            $status = 'nok';
        }
        $result['message'] = $message;
        $result['status'] = $status;
        return json_encode($result);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $file = $this->file_repo->find($id);
        $file->title = Input::get('title');
        $file->cat_id = Input::get('category');

        if($file->save()){
            return Redirect::to('admin/file');
        }else{
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        $this->file_repo->delete($id);
        return Redirect::to('admin/file');
    }
}