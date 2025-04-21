<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Product;

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
        View::composer('*', function ($view) {
            $cartItemsCount = 0;

            if (Auth::check()) {
                $cartItemsCount = CartItem::where('user_id', Auth::id())->count();
            } else {
                $sessionCart = session('cart', []);

                // Now count items after ensuring session is set
                $cartItemsCount = count(session('cart', []));
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
    }

}
