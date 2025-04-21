<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    public function shipping()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
            Log::debug($cartItems);
            $total = $cartItems->sum(fn($item) => $item->amount * $item->product->price);

        } else {
            $cart = session()->get('cart', []);
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            $cartItems = $products->map(function ($product) use ($cart) {
                $cartItem = new CartItem(); // create an instance without saving

                $cartItem->product_id = $product->id;
                $cartItem->product = $product; // set relationship manually
                $cartItem->amount = $cart[$product->id]['amount'] ?? null;
                $cartItem->selected_variants = $cart[$product->id]['selected_variants'] ?? [];

                return $cartItem;
            });
            Log::debug($cartItems);
            $total = $cartItems->sum(fn($item) => $item->amount * $item->product->price);
        }

        return view('paywall.shipping', [
            'cartItems' => $cartItems,
            'cartTotal' => $total
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transport_option' => ['required', 'in:store_pickup,standard_delivery,speedy_delivery'],
        ]);

        session(['checkout.shipping' => $validated]);

        return response()->json(['success' => true]);
    }
}
