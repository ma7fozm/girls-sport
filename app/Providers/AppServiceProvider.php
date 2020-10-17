<?php

namespace App\Providers;

use App\News;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('frontEnd.layouts.footer', function($view)
        {
            $news = News::orderBy('id','desc')->where('news_type','=','عام')->limit(4)->get();
            $view->with(['news'=> $news] );
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
