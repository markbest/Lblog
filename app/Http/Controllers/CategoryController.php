<?php namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\ArticleRepositoryEloquent;
use Cache;

class CategoryController extends Controller
{
    private $category_repo;
    private $article_repo;

    public function __construct(CategoryRepositoryEloquent $category_repo, ArticleRepositoryEloquent $article_repo)
    {
        $this->category_repo = $category_repo;
        $this->article_repo = $article_repo;
    }

    public function show($title)
	{
        $category = $this->category_repo->findWhere(['title' => $title])->first();
		if($category){
            $articles = $this->article_repo->getCategoryArticlesList($category->id);
		}else{
			abort(404);
		}
		return view('frontend.category.show' ,['articles' => $articles, 'title' => $category->title]);
	}

}