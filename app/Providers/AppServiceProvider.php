<?php

namespace Ignite\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Paginator::defaultView('pagination::materialize');
    
        //Validator::extend('phone_number', function($attribute, $value, $parameters)
        //{
        //    return substr($value, 0, 2) == '01';
        //});
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
