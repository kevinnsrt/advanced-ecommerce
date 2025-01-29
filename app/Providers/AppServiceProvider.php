<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.navbar', function ($view) {
            $cartCount = 0;

            if (auth()->check()) {
                $cartCount = Cart::where('user_id', auth()->id())->count();
            }

            $view->with('cartCount', $cartCount);
        });

        View::composer('layouts.navbar', function ($view) {
            $orderCount = 0;

            if (auth()->check()) {
                $orderCount = Order::where('username', auth()->user()->name)->count();
            }

            $view->with('orderCount', $orderCount);
        });
    }
}
