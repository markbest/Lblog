<?php

namespace App\Repositories;

use App\Article;
use DB;

class ArticleRepositoryEloquent
{
    public function getArticleWithCategoryName($id){
        $article = DB::table('articles')
                 ->join('categories', 'articles.cat_id', '=', 'categories.id')
                 ->select('articles.*', 'categories.title as category_name')
                 ->where('articles.id', $id)
                 ->first();
        return $article;
    }

    public function getCategoryArticlesList($category_id){
        $articles = Article::where('cat_id', $category_id)
                  ->orderBy('created_at', 'desc')
                  ->paginate(getConfig('web_perpage'));
        return $articles;
    }
}
