<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
<<<<<<< HEAD
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
=======
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
>>>>>>> develop

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
<<<<<<< HEAD
        if(App::environment(['production'])){
            URL::forceScheme('https');
        }
=======
        if (App::environment(['production']) || App::environment(['develop'])) {
            URL::forceScheme('https');
        };
>>>>>>> develop
    }
}
