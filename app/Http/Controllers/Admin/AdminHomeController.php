<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ArticleRepositoryEloquent;

use Illuminate\Http\Request;
use EndaEditor;

class AdminHomeController extends Controller {

    private $article_repo;

    public function __construct(ArticleRepositoryEloquent $article)
    {
        $this->article_repo = $article;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $articles = $this->article_repo->getAllWithCategory(30);
		return view('admin.article.index', ['articles' => $articles]);
	}
	
	public function upload()
	{
		$data = EndaEditor::uploadImgFile('uploads');
		return json_encode($data);
	}
}
