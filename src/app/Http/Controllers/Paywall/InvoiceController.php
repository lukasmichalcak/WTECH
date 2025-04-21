<?php

namespace App\Http\Controllers\Paywall;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\AddressDetails;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function invoice()
    {
        $addresses = auth()->check()
            ? AddressDetails::where('user_id', auth()->id())->get()
            : collect();

        $user = auth()->user();

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

        return view('paywall.invoice', [
            'addresses' => $addresses,
            'user' => $user,
            'cartItems' => $cartItems,
            'cartTotal' => $total
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
        ]);

        session(['checkout.invoice' => $validated]);

        return response()->json(['success' => true]);
    }

}
