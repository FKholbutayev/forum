<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channel;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()  {

        // share channel across application
        // View::share('channels', Channel::all());

        View::composer('*', function($view) {
            $view->with('channels', Channel::all());
        });
    }
}
