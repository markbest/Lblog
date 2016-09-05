<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Config;
use Redirect, Input, Auth;

class SettingController extends Controller {

	public function index()
	{
		return view('admin.setting')->withConfigs(Config::all());
	}
	
	public function store(Request $request)
	{
		if(is_array(Input::get('config'))){
			foreach(Input::get('config') as $key=>$value){
				$target_config = Config::where('path',$key)->first();
				$config = Config::find($target_config->id);
				$config->value = $value;
				$config->save();
			}
		}else{
			$config = new Config;
			$config->name = Input::get('name');
			$config->path = Input::get('path');
			$config->value = Input::get('value');

			if($config->save()){
				return Redirect::to('admin/setting');
			}else{
				return Redirect::back()->withInput()->withErrors('更新失败');
			}
		}
		return Redirect::to('admin/setting');
	}
}