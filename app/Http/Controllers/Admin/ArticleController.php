<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Article;
use App\Category;

use DB;
use Redirect, Input, Auth, Cache;

class ArticleController extends Controller {

	public function index()
	{
		if(Input::get('keywords') != ''){
			$articles = DB::table('articles')
					  ->join('categories', 'articles.cat_id', '=', 'categories.id')
					  ->select('articles.*', 'categories.title as category_name')
					  ->where('articles.title','like','%'.Input::get('keywords').'%')
					  ->orderBy('articles.created_at','desc')
					  ->paginate('30');
		}else{
			$articles = DB::table('articles')
					  ->join('categories', 'articles.cat_id', '=', 'categories.id')
					  ->select('articles.*', 'categories.title as category_name')
					  ->orderBy('articles.created_at','desc')
					  ->paginate('30');
		}

		return view('admin.article.index')->withArticles($articles);
	}

	public function create()
	{
		return view('admin.article.create')->withCategory(Category::all());
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'summary' => 'required',
			'body' => 'required',
			'cat_id' => 'required',
		]);

		$article = new Article;
		$article->title = Input::get('title');
		$article->slug = Input::get('slug');
		$article->summary = Input::get('summary');
		$article->body = Input::get('body');
		$article->cat_id = Input::get('cat_id');
		$article->user_id = 1;//Auth::user()->id;

		if ($article->save()) {
			Cache::forget('latest_articles');
			return Redirect::to('admin/article');
		} else {
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function edit($id)
	{
		return view('admin.article.edit')->withArticle(Article::find($id))->withCategory(Category::all());
	}

	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required',
			'summary' => 'required',
			'body' => 'required',
			'cat_id' => 'required',
		]);

		$article = Article::find($id);
		$article->title = Input::get('title');
		$article->slug = Input::get('slug');
		$article->summary = Input::get('summary');
		$article->body = Input::get('body');
		$article->cat_id = Input::get('cat_id');
		$article->user_id = 1;//Auth::user()->id;

		if ($article->save()) {
			Cache::forget('article_'.$id);
			return Redirect::to('admin/article');
		} else {
			return Redirect::back()->withInput()->withErrors('更新失败');
		}
	}

	public function destroy($id)
	{
		$article = Article::find($id);
		$article->delete();
		Cache::forget('article_'.$id);

		return Redirect::to('admin/article');
	}
}