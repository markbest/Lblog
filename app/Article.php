<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {
	public function addArticlesViews()
	{
		$article = $this;
	    $article->views = $article->views + 1;
	    $article->save(); 
	}

	public function category(){
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }

}
