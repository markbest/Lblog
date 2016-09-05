<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	public function hasManyComments()
    {
		return $this->hasMany('App\Comment', 'article_id', 'id');
	}
	
	public function addArticlesViews($id)
	{
		$article = self::find($id);
	    $article->views = $article->views + 1;
	    $article->save();
	}

}
