<?php namespace App\Http\Controllers;

use App\Article;
use DB;
use Redirect, Input, Auth, Cache;

class SearchController extends Controller {
  
  	public function show()
	{
		$keywords = Input::get('s');
		$articles = DB::table('articles')
				  ->join('categories', 'articles.cat_id', '=', 'categories.id')
			      ->select('articles.*', 'categories.title as category_name')
			      ->where('articles.title','like','%'.$keywords.'%')
			      ->orderBy('articles.created_at','desc')
			      ->paginate('6');
		$page = Input::get('page') ? Input::get('page') : 1;
		$articles = $articles->appends(array(
			's' => $keywords,
			'page' => $page
		));
		return view('frontend.category.show')->withArticles($articles)->withTitle('搜索：'.$keywords);
	}

}