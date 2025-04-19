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

                // If empty, insert test item
                if (empty($sessionCart)) {
                    $product = Product::inRandomOrder()->first();
                    $selectedVariants = [];

                    foreach ($product->attributes as $attribute) {
                        $firstVariant = $attribute->variants()->first();
                        if ($firstVariant) {
                            $selectedVariants[$attribute->name] = $firstVariant->name;
                        }
                    }

                    $key = $product->id;

                    $sessionCart[$key] = [
                        'amount' => intdiv($product->stock, 2),
                        'selected_variants' => $selectedVariants,
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
