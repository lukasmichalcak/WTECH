<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

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

                // If empty, insert test item
                if (empty($sessionCart)) {
                    $productId = '019642c1-cfc8-7270-b98b-0d870af2c3fe';
                    $variants = [
                        'Display Size' => '13',
                        'Ports' => 'HDMI',
                    ];

                    $key = $productId;

                    $sessionCart[$key] = [
                        'amount' => 15,
                        'selected_variants' => $variants,
                    ];

                    session()->put('cart', $sessionCart);
                }

                // Now count items after ensuring session is set
                $cartItemsCount = count(session('cart', []));
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
    }

}
