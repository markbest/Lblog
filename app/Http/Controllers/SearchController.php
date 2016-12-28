<?php namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryEloquent;
use DB, Redirect, Input, Auth, Cache;

class SearchController extends Controller {

    private $article_repo;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article_repo = $article;
    }

    public function show()
	{
		$keywords = Input::get('s');
        $page = Input::get('page') ? Input::get('page') : 1;
        $articles = $this->article_repo->getSearchResult($keywords, 6);
		$articles = $articles->appends(array(
			's' => $keywords,
			'page' => $page
		));
		return view('frontend.category.show')->withArticles($articles)->withTitle('搜索：'.$keywords);
	}
}