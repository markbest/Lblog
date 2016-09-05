<?php namespace App\Http\Controllers;

use App\Article;
use DB;
use EndaEditor;
use Cache;

class ArticleController extends Controller {

  public function show($id)
  {
	  if(Cache::has('article_'.$id)){
		  $article = Cache::get('article_'.$id);
	  }else{
		  $article = DB::table('articles')
			       ->join('categories', 'articles.cat_id', '=', 'categories.id')
				   ->join('comments', 'articles.id', '=', 'article_id')
			       ->select('articles.*', 'categories.title as category_name', DB::raw("count('comments.*') as reviews"))
			       ->where('articles.id',$id)
			       ->first();
		  if($article->id){
			  $article->body = EndaEditor::MarkDecode($article->body);
			  Cache::forever('article_'.$id,$article);
		  }else{
			  abort(404);
		  }
	  }
	  $current_article = Article::find($id)->addArticlesViews($id);
	  $comments = Article::find($id)->hasManyComments;
	  return view('article.show',['article'=>$article,'comment'=>$comments]);
  }
}