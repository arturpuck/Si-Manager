<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class ViewFilePathsServiceProvider extends ServiceProvider
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
        View::composer(
            "*",
            function ($view) {

                $legitViewsNames = [
                    'login',
                    'dashboard',
                    'movie_creator',
                    'movie_candidate_creator'
                ];

                $viewName = Str::afterLast($view->getName(), ".");
                if (in_array($viewName, $legitViewsNames)) {
                    View::share('cssFilePath', asset("css/" . $viewName . ".css"));
                    View::share('jsFilePath',  asset("js/" . $viewName . ".js"));
                }
            }
        );
    }
}
