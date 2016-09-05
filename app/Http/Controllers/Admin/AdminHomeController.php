<?php namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;
use EndaEditor;

class AdminHomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = DB::table('articles')
		          ->join('categories', 'articles.cat_id', '=', 'categories.id')
		          ->select('articles.*', 'categories.title as category_name')
		          ->orderBy('articles.created_at','desc')
				  ->paginate('24');
		return view('admin.article.index')->withArticles($articles);
	}
	
	public function upload()
	{
		$data = EndaEditor::uploadImgFile('uploads');
		return json_encode($data);
	}
}
