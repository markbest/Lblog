<?php namespace App\Http\Controllers;

use App\Article;

class HomeController extends Controller {

	public function index()
	{
		return view('home')->withArticles(Article::orderBy('created_at','desc')->paginate(getConfig('web_perpage')));
	}
}