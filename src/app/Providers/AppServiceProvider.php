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
//                if (empty($sessionCart)) {
//                    $productId = '01964301-47d2-7261-9818-dbfef7e7c8b3';
//                    $variants = [
//                        'Resolution' => 'HD',
//                        'Touchscreen' => 'Yes',
//                        'RAM' => '8GB',
//                    ];
//
//                    $key = $productId;
//
//                    $sessionCart[$key] = [
//                        'amount' => 15,
//                        'selected_variants' => $variants,
//                    ];
//
//                    session()->put('cart', $sessionCart);
//                }

                // Now count items after ensuring session is set
                $cartItemsCount = count(session('cart', []));
            }

            $view->with('cartItemsCount', $cartItemsCount);
        });
    }

}
