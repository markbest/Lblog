<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Redirect, Input, Auth;
use App\File;
use DB;

class FileController extends Controller{
    public function index(){
        $files = DB::table('files')
               ->leftjoin('categories', 'files.cat_id', '=', 'categories.id')
               ->select('files.*', 'categories.title as category_name')
               ->orderBy('files.created_at','desc')
               ->paginate('30');
        return view('admin.file')->withFiles($files);
    }

    public function upload(){
        $path = 'uploads/file/'.date('Y').'/'.date('m');
        if(!file_exists($path)){
            mkdir($path,0777,true);
        }

        $result = array();
        try{
            $file = Input::file('file');
            if($file->isValid()){
                $newName =  md5(date('ymdhis').$file->getClientOriginalName()).".".$file->getClientOriginalExtension();
                $file->move($path, $newName);

                $status = 'ok';
                $message = 'success upload';

                $document = New File;
                $document->cat_id = 0;
                $document->name = $file->getClientOriginalName();
                $document->size = $file->getClientSize();
                $document->link = $path.'/'.$newName;
                $document->type = $file->getClientOriginalExtension();
                $document->created_at = date('Y-m-d h:i:s', time());
                $document->save();

            }else{
                $message = $e->getMessage();
                $status = 'nok';
            }
        }catch (\Exception $e){
            $message = 'Some error occurs when uploading file';
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

        $file = File::find($id);
        $file->title = Input::get('title');
        $file->cat_id = Input::get('category');

        if ($file->save()) {
            return Redirect::to('admin/file');
        } else {
            return Redirect::back()->withInput()->withErrors('更新失败');
        }
    }

    public function destroy($id)
    {
        $file = File::find($id);
        $file->delete();

        return Redirect::to('admin/file');
    }
}