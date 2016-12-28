<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'parent_id', 'sort'];

    /**
     * @return mixed
     */
	public function hasManyArticles()
    {
		return $this->hasMany('App\Article','cat_id','id')->orderBy('created_at','desc');
	}
}
