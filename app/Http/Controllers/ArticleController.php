<?php namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryEloquent;
use App\Article;
use DB;
use EndaEditor;
use Cache;

class ArticleController extends Controller
{
    private $article_repo;

    public function __construct(ArticleRepositoryEloquent $article_repo)
    {
        $this->article_repo = $article_repo;
    }

    public function show($id)
    {
	    if(Cache::has('article_'.$id)){
		    $article = Cache::get('article_'.$id);
	    }else{
            $article = $this->article_repo->getArticleWithCategoryName($id);
		    if($article->id){
			    $article->body = EndaEditor::MarkDecode($article->body);
			    Cache::forever('article_'.$id,$article);
		    }else{
			    abort(404);
		    }
	    }
	    Article::find($id)->addArticlesViews();
	    return view('frontend.article.show',['article'=>$article]);
    }
}