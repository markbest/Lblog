<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cache;

class PartServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->composeSidebar();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
	
	private function composeSidebar()
	{
		view()->composer('parts.top', function ($view) {
			if(Cache::has('all_categories')){
				$Categories = Cache::get('all_categories');
			}else{
				$Categories = getAllCategoryList();
				Cache::forever('all_categories', $Categories);
			}
			$view->with(compact('Categories'));
		});
		
		view()->composer('parts.sidebar', function ($view) {
			if(Cache::has('latest_articles')){
				$NewestArticles = Cache::get('latest_articles');
			}else{
				$NewestArticles = \App\Article::latest()->take(8)->select('id','title')->get();
				Cache::put('latest_articles', $NewestArticles, getConfig('web_cache_time'));
			}

			if(Cache::has('mostview_articles')){
				$MostviewArticles = Cache::get('mostview_articles');
			}else{
				$MostviewArticles = \App\Article::orderBy('views','desc')->take(8)->select('id','title','views')->get();
				Cache::put('mostview_articles', $MostviewArticles, getConfig('web_cache_time'));
			}
			$view->with(compact('NewestArticles','MostviewArticles'));
		});
	}
}
