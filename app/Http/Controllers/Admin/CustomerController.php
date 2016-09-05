<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Customer;

use Redirect, Input;

class CustomerController extends Controller {

	public function index()
	{
		return view('admin.customer.index')->withCustomers(Customer::all());
	}

	public function edit($id)
	{
		return view('admin.customer.edit')->withCustomer(Customer::find($id));
	}

	public function update(Request $request, $id)
	{ 
		$this->validate($request, [
			'name' => 'required'
		]);
		if(Input::get('password')){
			if(Customer::where('id', $id)->update(['name'=>Input::get('name'),'password'=>md5(Input::get('password'))])){
				return Redirect::to('admin/customer');
			}else{
				return Redirect::back()->withInput()->withErrors('更新失败');
			}
		}else{
			if(Customer::where('id', $id)->update(['name'=>Input::get('name')])){
				return Redirect::to('admin/customer');
			}else{
				return Redirect::back()->withInput()->withErrors('更新失败');
			}
		}
	}

	public function destroy($id)
	{
		$customer = Customer::find($id);
		$customer->delete();

		return Redirect::to('admin/customer');
	}

}