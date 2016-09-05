<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cache;

use App\Category;

use Redirect, Input, Auth;

class CategoryController  extends Controller {

	public function index()
	{
		return view('admin.category.index')->withCategory(Category::all());
	}

	public function create()
	{
		return view('admin.category.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required'
		]);

		$category = new Category;
		$category->title = Input::get('title');

		if ($category->save()) {
			Cache::forget('all_categories');
			return Redirect::to('admin/category');
		} else {
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function edit($id)
	{
		return view('admin.category.edit')->withCategory(Category::find($id));
	}

	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required'
		]);

		$category = Category::find($id);
		$category->title = Input::get('title');

		if ($category->save()) {
			Cache::forget('all_categories');
			return Redirect::to('admin/category');
		} else {
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function destroy($id)
	{
		$category = Category::find($id);
		$category->delete();

		Cache::forget('all_categories');
		return Redirect::to('admin/category');
	}
}