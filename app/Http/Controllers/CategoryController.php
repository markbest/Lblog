<?php namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryEloquent;

use Cache;

class CategoryController extends Controller
{
    private $category_repo;

    public function __construct(CategoryRepositoryEloquent $category)
    {
        $this->category_repo = $category;
    }

    public function show($title)
	{
        $category = $this->category_repo->findWhere(['title' => $title])->first();
		if($category){
            $articles = $this->category_repo->getArticles($category->id);
		}else{
			abort(404);
		}
		return view('frontend.category.show' ,['articles' => $articles, 'title' => $category->title]);
	}

}