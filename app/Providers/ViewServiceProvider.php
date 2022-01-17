<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Article;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		//Eager loading 'with' method. Use 'take' or 'limit'
		//$articles = Article::with('statistics','tags')->orderBy('created_at','desc')->take(6)->get();
        //We use 'scope' method from Model
		$articles = Article::lastLimit(5);
		//
		View::composer('site.common_templates.sidebar', function ($view) use ($articles){
            //
			$view->with('lastArticles', $articles);
        });
    }
}
