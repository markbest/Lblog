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
Route::get('search', 'SearchController@show');
Route::get('file/list', 'FileController@show');
Route::get('file/download/{id}', 'FileController@download');

Route::resource('customer/login', 'CustomerController@login');
Route::resource('customer/register', 'CustomerController@register');
Route::resource('customer/setting', 'CustomerController@setting');
Route::get('customer/logout', 'CustomerController@logout');
Route::get('customer/home', 'CustomerController@index');
Route::get('customer/works', 'CustomerController@work');
Route::post('customer/upload', 'CustomerController@upload');

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
	Route::resource('file', 'FileController');
	Route::resource('file/upload', 'FileController@upload');
	Route::resource('customer', 'CustomerController');
	Route::resource('picture', 'PictureController');
	Route::resource('picture/upload', 'PictureController@upload');
	Route::resource('setting', 'SettingController');
});
