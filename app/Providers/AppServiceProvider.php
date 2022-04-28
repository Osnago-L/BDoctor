<?php

namespace App\Providers;
use View;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
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
        //
        /* View::composer('*', function($view){
            //any code to set $val variable
            $user = Auth::user();
            $view->with('foo', $val);
        }); */
        date_default_timezone_set('Europe/Rome');

        View::share('user');
    }
}
