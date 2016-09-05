<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('article/{id}', 'ArticleController@show');
Route::get('category/{title}', 'CategoryController@show');
Route::post('comment/store', 'CommentsController@store');

Route::get('customer/login', 'CustomerController@login');
Route::post('customer/login', 'CustomerController@login');
Route::get('customer/register', 'CustomerController@register');
Route::post('customer/register', 'CustomerController@register');
Route::get('customer/logout', 'CustomerController@logout');
Route::get('customer/home', 'CustomerController@index');
Route::resource('customer/setting', 'CustomerController@setting');
Route::post('customer/upload', 'CustomerController@upload');
Route::get('picture', 'PictureController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
    Route::get('/', 'AdminHomeController@index');
    Route::post('upload', 'AdminHomeController@upload');
    Route::resource('article', 'ArticleController');
	Route::resource('category', 'CategoryController');
	Route::resource('comments', 'CommentsController');
	Route::resource('customer', 'CustomerController');
	Route::resource('picture', 'PictureController');
	Route::resource('picture/upload', 'PictureController@upload');
	Route::resource('setting', 'SettingController');
});
