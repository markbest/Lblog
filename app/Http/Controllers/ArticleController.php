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
	  Article::find($id)->addArticlesViews($id);
	  return view('frontend.article.show',['article'=>$article]);
  }
}