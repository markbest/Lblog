<?php namespace App\Http\Controllers;

use App\Picture;

class PictureController extends Controller {

	public function index()
	{
		return view('frontend.picture.list')->withPictures(Picture::all()->sortBy('created_at desc'));
	}
}