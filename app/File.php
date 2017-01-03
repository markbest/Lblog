<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'cat_id', 'name', 'size', 'link', 'type', 'created_at'];

    public $timestamps = false;
}
