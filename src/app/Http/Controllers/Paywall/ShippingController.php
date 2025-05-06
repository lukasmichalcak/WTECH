<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{
    public function shipping()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
            foreach ($cartItems as $item) {
                $product = $item->product;
                if (!$product) continue;

                $image = DB::table('images')
                    ->join('image_product', 'images.id', '=', 'image_product.image_id')
                    ->where('image_product.product_id', $product->id)
                    ->select('images.path')
                    ->whereNull('images.deleted_at')
                    ->first();

                $product->image_path = $image
                    ? asset('resources/images/' . $image->path)
                    : asset('resources/images/default-product.png');
            }
            Log::debug($cartItems);
            $total = $cartItems->sum(fn($item) => $item->amount * $item->product->price);

        } else {
            $cart = session()->get('cart', []);
            $compositeKeys = array_keys($cart);
            $productIds = collect($compositeKeys)->map(function ($key) {
                return explode('::', $key)[0];
            })->unique()->values();

            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');
            foreach ($products as $product) {
                $image = DB::table('images')
                    ->join('image_product', 'images.id', '=', 'image_product.image_id')
                    ->where('image_product.product_id', $product->id)
                    ->select('images.path')
                    ->whereNull('images.deleted_at')
                    ->first();

                $product->image_path = $image
                    ? asset('resources/images/' . $image->path)
                    : asset('resources/images/default-product.png');

                Log::debug("Set image path for product {$product->id}: " . $product->image_path);
            }

            $cartItems = collect($cart)->map(function ($entry, $compositeKey) use ($products) {
                [$productId, $variantHash] = explode('::', $compositeKey);

                $cartItem = new CartItem();
                $cartItem->product_id = $productId;
                $cartItem->product = $products[$productId] ?? null;
                $cartItem->amount = $entry['amount'] ?? 0;
                $cartItem->selected_variants = $entry['selected_variants'] ?? [];

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
