<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	public function hasManyArticles()
    {
		return $this->hasMany('App\Article','cat_id','id')->orderBy('created_at','desc');
	}
}
