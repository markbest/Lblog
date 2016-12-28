<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\CategoryRepository;

use App\Category;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Get Category article list
     *
     * @param $category_id
     * @return mixed
     */
    public function getArticles($cat_id)
    {
        $category = $this->makeModel()->find($cat_id);
        $articles = $category->hasManyArticles()->paginate(getConfig('web_perpage'));
        return $articles;
    }
}
