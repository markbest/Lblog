<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PictureRepositoryEloquent;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Redirect, Input, Auth;

class PictureController extends Controller
{
    private $picture_repo;

    public function __construct(PictureRepositoryEloquent $picture)
    {
        $this->picture_repo = $picture;
    }

    public function index()
	{
		return view('admin.picture.index');
	}
	
	public function upload()
	{
		$result = array();
		try{
			$pic = Input::file('file');
			if($pic->isValid()){
				$newName =  date('Y'). DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . md5(date('ymdhis').$pic->getClientOriginalName()).".".$pic->getClientOriginalExtension();
                Storage::disk('image')->put($newName, file_get_contents($pic->getRealPath()));
				
				$status = 'ok';
				$message = 'success upload';

                $this->picture_repo->create(['img_url' => $newName]);
			}else{
				$message = 'Some error occurs when uploading file';
				$status = 'nok';
			}
		}catch (\Exception $e){
			$message = 'Some error occurs when uploading file';
			$status = 'nok';
		}
		$result['message'] = $message;
		$result['status'] = $status;
		$result['url'] = storage_path('app/public/image') . DIRECTORY_SEPARATOR . $newName;
		return json_encode($result);
	}
	
	public function create()
	{
        $pictures = $this->picture_repo->all()->sortBy('created_at desc');
		return view('admin.picture.list', ['pictures' => $pictures]);
	}
	
	public function update(Request $request,$id)
	{
		if(Input::get('delete')){
            $this->picture_repo->delete($id);
		}else{
            $picture = $this->picture_repo->update(['note' => Input::get('note')],$id);
			if($picture){
				return Redirect::to('admin/picture/create');
			}else{
				return Redirect::back()->withInput()->withErrors('更新失败');
			}
		}
		return Redirect::to('admin/picture/create');
	}
}