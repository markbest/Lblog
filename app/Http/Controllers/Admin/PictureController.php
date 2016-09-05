<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Redirect, Input, Auth;
use App\Picture;

class PictureController extends Controller {

	public function index()
	{
		return view('admin.picture.index');
	}
	
	public function upload()
	{
		$path = 'uploads/picture/'.date('Y').'/'.date('m');
		if(!file_exists($path)){
			mkdir($path,0777,true);
		}
		
		$result = array();
		$url = '';
		try{
			$pic = Input::file('file');
			if($pic->isValid()){
				$newName =  md5(date('ymdhis').$pic->getClientOriginalName()).".".$pic->getClientOriginalExtension();
				$pic->move($path,$newName);
				$url = asset($path.'/'.$newName);
				
				$status = 'ok';
				$message = 'success upload';
				
				$picture = new Picture;
				$picture->img_url = $url;
				$picture->save();
				
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
		$result['url'] = $url;
		return json_encode($result);
	}
	
	public function create()
	{
		return view('admin.picture.list')->withPictures(Picture::all()->sortBy('created_at desc'));
	}
	
	public function update(Request $request,$id)
	{
		$picture = Picture::find($id);
		if(Input::get('delete')){
			$picture->delete();
		}else{
			$picture->note = Input::get('note');
			if($picture->save()){
				return Redirect::to('admin/picture/create');
			}else{
				return Redirect::back()->withInput()->withErrors('更新失败');
			}
		}
		return Redirect::to('admin/picture/create');
	}
}