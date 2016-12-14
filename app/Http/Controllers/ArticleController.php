<?php namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryEloquent;
use App\Article;
use DB;
use EndaEditor;
use Cache;
use Illuminate\Support\Facades\Event;
use App\Events\BlogView;

class ArticleController extends Controller
{
    private $article_repo;

  public function show($id)
  {
	  if(Cache::has('article_'.$id)){
		  $article = Cache::get('article_'.$id);
	  }else{
		  $article = DB::table('articles')
			       ->join('categories', 'articles.cat_id', '=', 'categories.id')
			       ->select('articles.*', 'categories.title as category_name')
			       ->where('articles.id',$id)
			       ->first();
		  if($article->id){
			  $article->body = EndaEditor::MarkDecode($article->body);
			  Cache::forever('article_'.$id,$article);
		  }else{
			  abort(404);
		  }
	  }
      Event::fire(new BlogView(Article::find($id)));
	  return view('frontend.article.show',['article'=>$article]);
  }
}