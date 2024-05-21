<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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
        Auth::extend('customers', function ($app, $name, array $config) {
            return new \Illuminate\Auth\SessionGuard($name, Auth::createUserProvider($config['provider']), $app['session.store']);
        });

        view()->composer('*', function ($view) {
            $CategoryHome = Category::orderBy('name', 'ASC')->where('status', 1)->get();
            // dd($CategoryHome);
            $view->with(compact('CategoryHome'));
        });
        view()->composer('*', function ($view) {
            $carts = Cart::where('customer_id', auth('customers')->id())->get();
            // dd($CategoryHome);
            $view->with(compact('carts'));
        });

    }
}
