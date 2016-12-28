<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\CategoryRepositoryEloquent;

use Cache, Redirect, Input, Auth;

class CategoryController  extends Controller {

    private $category_repo;

    public function __construct(CategoryRepositoryEloquent $category)
    {
        $this->category_repo = $category;
    }

    public function index()
	{
        $category = $this->category_repo->orderBy('sort','asc')->findWhere(['parent_id' => '0']);
		return view('admin.category.index')->withCategory($category);
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

        $category = $this->category_repo->create([
            'title' => Input::get('title'),
            'parent_id' => Input::get('category'),
            'sort' => 0
        ]);

		if($category){
			Cache::forget('all_categories');
			return Redirect::to('admin/category');
		}else{
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function edit($id)
	{
		return view('admin.category.edit', ['category' => $this->category_repo->find($id)]);
	}

	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required',
		]);

        $category = $this->category_repo->update([
            'title' => Input::get('title'),
            'parent_id' => Input::get('category'),
            'sort' => Input::get('sort')
        ],$id);

		if($category){
			Cache::forget('all_categories');
			return Redirect::to('admin/category');
		}else{
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function destroy($id)
	{
        $this->category_repo->delete($id);
		Cache::forget('all_categories');

		return Redirect::to('admin/category');
	}
}