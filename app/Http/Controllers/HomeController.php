<?php namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryEloquent;

class HomeController extends Controller {

    private $article_repo;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article_repo = $article;
    }

    public function index()
	{
        $articles = $this->article_repo->orderBy('created_at','desc')->paginate(getConfig('web_perpage'));
		return view('home', ['articles' => $articles]);
	}
}