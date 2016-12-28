<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\ArticleRepositoryEloquent;
use App\Repositories\CategoryRepositoryEloquent;

use DB, Redirect, Input, Auth, Cache;

class ArticleController extends Controller {

    private $article_repo;
    private $category_repo;

    public function __construct(ArticleRepositoryEloquent $article, CategoryRepositoryEloquent $category)
    {
        $this->article_repo = $article;
        $this->category_repo = $category;
    }

    public function index()
	{
        $keywords = Input::get('keywords');
        $articles = $this->article_repo->getSearchResult($keywords);
		return view('admin.article.index', ['articles' => $articles]);
	}

	public function create()
	{
		return view('admin.article.create', ['category' => $this->category_repo->all()]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'summary' => 'required',
			'body' => 'required',
			'cat_id' => 'required',
		]);

        $article = $this->article_repo->create([
            'title' => Input::get('title'),
            'slug' => Input::get('slug'),
            'summary' => Input::get('summary'),
            'body' => Input::get('body'),
            'cat_id' => Input::get('cat_id'),
            'user_id' => Auth::id()
        ]);

		if($article){
			Cache::forget('latest_articles');
			return Redirect::to('admin/article');
		}else{
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function edit($id)
	{
        $articles = $this->article_repo->find($id);
        $categories = $this->category_repo->all();
		return view('admin.article.edit', ['article' => $articles, 'category' => $categories]);
	}

	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required',
			'summary' => 'required',
			'body' => 'required',
			'cat_id' => 'required',
		]);

        $article = $this->article_repo->update([
            'title' => Input::get('title'),
            'slug' => Input::get('slug'),
            'summary' => Input::get('summary'),
            'body' => Input::get('body'),
            'cat_id' => Input::get('cat_id'),
            'user_id' => Auth::id()
        ], $id);

		if($article){
			Cache::forget('article_'.$id);
			return Redirect::to('admin/article');
		}else{
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function destroy($id)
	{
        $this->article_repo->delete($id);
		Cache::forget('article_'.$id);

		return Redirect::to('admin/article');
	}
}