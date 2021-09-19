<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // share error msgs
        Inertia::share([
        'errors' => function () {
            return Session::get('errors')
                ? Session::get('errors')->getBag('default')->getMessages()
                : (object) [];
            },
        ]);

        // share success msgs
        Inertia::share([
        'successMessage' => function () {
            return Session::get('successMessage')
                ? Session::get('successMessage')->getBag('default')->getMessages()
                : null;
            },
        ]);

    }
    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
