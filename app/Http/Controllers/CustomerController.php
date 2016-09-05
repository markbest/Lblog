<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Redirect, Input, Hash;

use App\Customer;
use Stringy\create;
use Cookie;
use Mail;

class CustomerController extends Controller {

	public function __construct(){
		$this->middleware('login',array('except'=>array('login','register','logout')));
	}
	
	public function index()
	{
		return view('customer.index');
	}
	
	public function register(Request $request)
	{
		if(Input::has('email')){
			$this->validate($request, [
					'name' => 'required',
					'email' => 'email|unique:customers',
					'password' => 'required|min:6|confirmed',
					'password_confirmation' => 'required',
					]);
			
			$customer = new Customer;
			$customer->name = Input::get('name');
			$customer->email = Input::get('email');
			$customer->remember_token = Input::get('_token');
			$customer->password = md5(Input::get('password'));
			
			if($customer->save()){
				$user = [
				    "id" => $customer->id,
					"name" => $customer->name,
					"email" => $customer->email,
					"token" => $customer->remember_token
				];
				Cookie::queue("TOKEN", json_encode($user),3600);
				
				Mail::queue('emails.register', ['email' => $customer->email], function($message) use ($customer)
				{
					$message->to($customer->email, $customer->name)->subject('Welcome to register mark-here.com!');
				});
				return Redirect::action("CustomerController@login", ["path" => $request->fullUrl()]);
			}else{
				return Redirect::back()->withInput()->withErrors('注册失败');
			}
		}else{
			$token = Cookie::get("TOKEN");
			if(isset($token)){
				return Redirect::to('customer/home');
			}else{
				return view('customer.register');
			}
		}
	}
	
	public function login(Request $request)
	{
		if(Input::has('email')){
			$this->validate($request, [
					'email' => 'email',
					'password' => 'required',
					]);
			
			$customer_id = '0';
			$customer = Customer::where('email',Input::get('email'))->first();
			if($customer->id){
				if($customer->password == md5(Input::get('password'))){
					$customer->remember_token = Input::get('_token');
					$customer->save();
					
					$user = [
						"id" => $customer->id,
						"name" => $customer->name,
						"email" => $customer->email,
						"token" => $customer->remember_token
					];
					Cookie::queue("TOKEN", json_encode($user),60);
					return Redirect::action("CustomerController@login", ["path" => $request->fullUrl()]);
				}else{
					return Redirect::back()->withInput()->withErrors('用户名或密码错误，登录失败');
				}
			}else{
				return Redirect::back()->withInput()->withErrors('用户名或密码错误，登录失败');
			}
		}else{
			$token = Cookie::get("TOKEN");
			if(isset($token)){
				return Redirect::to('customer/home');
			}else{
				return view('customer.login');
			}
		}
	}
	
	public function logout()
	{
		Cookie::queue("TOKEN", null , -1);
		return Redirect::to('customer/login');
	}
	
	public function upload()
	{
		$path = 'uploads/avatar/'.date('Y').'/'.date('m').'/'.date('d');
		if(!file_exists($path)){
			mkdir($path,0777,true);
		}
		
		$res['error'] = "";
		$res['msg'] = "";
		try{
			$pic = Input::file('customer_icon');
			if($pic->isValid()){
				$newName =  md5(date('ymdhis')."mark_here").".".$pic->getClientOriginalExtension();
				$pic->move($path,$newName);
				$url = asset($path.'/'.$newName);
				
				$customer = Customer::find(getCustomer()->id);
				$customer->icon = $path.'/'.$newName;
				$customer->save();
				$res["msg"] = $url;
			}else{
				$res["error"] = 'The file is invalid';
			}
		}catch (\Exception $e){
			$res["error"] = $e->getMessage();
		}
		return json_encode($res);
	}
	
	public function setting(Request $request)
	{
		if(Input::has('customer_id') && Input::has('name')){
			$this->validate($request, [
				'name' => 'required',
			]);
			
			$customer = Customer::find(Input::get('customer_id'));
			$customer->name = Input::get('name');
			
			if($customer->save()){
				$user = [
					"id" => $customer->id,
					"name" => $customer->name,
					"email" => $customer->email,
					"token" => $customer->remember_token
				];
				Cookie::queue("TOKEN", json_encode($user),60);
				return Redirect::to('customer/setting');
			}else{
				return Redirect::back()->withInput()->withErrors('修改用户信息失败');
			}
		}else if(Input::has('customer_id') && Input::has('password')){
			$this->validate($request, [
				'old_password' => 'required',
				'password' => 'required|confirmed',
				'password_confirmation' => 'required',
			]);
			$customer = Customer::find(Input::get('customer_id'));
			if($customer->password == md5(Input::get('old_password'))){
				if(Input::get('password') == Input::get('password_confirmation')){
					$customer->password = md5(Input::get('password'));
					if($customer->save()){
						return Redirect::to('customer/setting');
					}else{
						return Redirect::back()->withInput()->withErrors('修改用户信息失败');
					}
				}
			}else{
				return Redirect::back()->withInput()->withErrors('初始密码错误，请重新输入');
			}
		}else{
			return view('customer.setting');
		}
	}
}