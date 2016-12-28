<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'summary', 'body', 'user_id', 'cat_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function category(){
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }
}
