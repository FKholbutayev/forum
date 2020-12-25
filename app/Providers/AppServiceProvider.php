<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channel;
use View;
use Illuminate\Support\Facades\Cache;

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
            $channels = Cache::rememberForever('channels', function () {
                return Channel::all();
            });
            $view->with('channels', $channels);
        });
    }
}
