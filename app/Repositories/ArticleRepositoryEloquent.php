<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\ArticleRepository;

use App\Article;
use DB;

class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    /**
     * Get Article with Category Name
     *
     * @param $id
     * @return mixed
     */
    public function getWithCategory($id)
    {
        $article = DB::table('articles')
                 ->join('categories', 'articles.cat_id', '=', 'categories.id')
                 ->select('articles.*', 'categories.title as category_name')
                 ->where('articles.id', $id)
                 ->first();
        return $article;
    }

    /**
     * Get Search Result By keyword
     *
     * @param $keyword
     * @return mixed
     */
    public function getSearchResult($keyword){
        $articles = DB::table('articles')
                  ->join('categories', 'articles.cat_id', '=', 'categories.id')
                  ->select('articles.*', 'categories.title as category_name')
                  ->where(function($query) use ($keyword){
                      if($keyword){
                          $query->where('articles.title','like','%'.$keyword.'%');
                      }
                  })
                  ->orderBy('articles.created_at','desc')
                  ->paginate('30');
        return $articles;
    }

    /**
     * Get all articles with category
     *
     * @return mixed
     */
    public function getAllWithCategory()
    {
        $articles = DB::table('articles')
            ->join('categories', 'articles.cat_id', '=', 'categories.id')
            ->select('articles.*', 'categories.title as category_name')
            ->orderBy('articles.created_at','desc')
            ->paginate('30');
        return $articles;
    }
}
