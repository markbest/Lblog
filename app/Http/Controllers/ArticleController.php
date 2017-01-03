<?php namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryEloquent;

use EndaEditor;
use Cache;
use Response;

use Illuminate\Support\Facades\Event;
use App\Events\BlogView;

class ArticleController extends Controller
{
    private $article_repo;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article_repo = $article;
    }

    public function show($id)
    {
	    if(Cache::has('article_'.$id)){
		    $article = Cache::get('article_'.$id);
	    }else{
            $article = $this->article_repo->getWithCategory($id);
            $article->body = EndaEditor::MarkDecode($article->body);
            Cache::forever('article_'.$id,$article);
	    }
        Event::fire(new BlogView($this->article_repo->find($id)));
	    return view('frontend.article.show',['article'=>$article]);
    }
	
	public function listAll()
	{
		$articles = $this->article_repo->orderBy('id', 'asc')->all(['id', 'title']);
		return Response()->json($articles);
	}
	
	public function info($id)
	{
		$article = $this->article_repo->find($id);
		return Response()->json($article);
	}
}