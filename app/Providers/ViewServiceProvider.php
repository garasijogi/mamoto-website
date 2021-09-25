<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['home', 'portfolio', 'showportfolio', 'about', 'booknow', 'booksuccess', 'contact', 'faq', 'feedback', 'promo'],
            'App\Http\View\Composers\ClientComposer'
        );
    }
}