<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use App\Models\CardDetails;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function payment()
    {
        $cards = auth()->check()
            ? CardDetails::where('user_id', auth()->id())->get()
            : collect();

        $user = auth()->user();

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItems = CartItem::with('product')->where('user_id', $userId)->get();
            Log::debug($cartItems);
            $total = $cartItems->sum(fn($item) => $item->amount * $item->product->price);

        } else {
            $cart = session()->get('cart', []);
            $compositeKeys = array_keys($cart);
            $productIds = collect($compositeKeys)->map(function ($key) {
                return explode('::', $key)[0];
            })->unique()->values();

            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

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

        return view('paywall.payment', [
            'cards' => $cards,
            'user' => $user,
            'cartItems' => $cartItems,
            'cartTotal' => $total
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:card,internetBanking,cashInPlace'],
        ]);

        session(['checkout.payment' => $validated]);

        return response()->json(['success' => true]);
    }

    public function finalize(Request $request)
    {
        $invoice = session('checkout.invoice');
        $shipping = session('checkout.shipping');
        $payment = session('checkout.payment');

        if (!$invoice || !$shipping || !$payment) {
            return redirect()->back()->with('error', 'Some checkout steps are missing.');
        }

        $user = auth()->user();
        $userId = $user?->id;

        $cart = session()->get('cart', []);
        $compositeKeys = array_keys($cart);

        $cartItems = auth()->check()
            ? CartItem::with('product')->where('user_id', $userId)->get()
            : collect(session('cart', []))->map(function ($data, $compositeKey) {
                [$productId, $variantHash] = explode('::', $compositeKey, 2);
                $product = Product::find($productId);

                $cartItem = new CartItem();
                $cartItem->product_id = $productId;
                $cartItem->product = $product;
                $cartItem->amount = $data['amount'];
                $cartItem->selected_variants = $data['selected_variants'] ?? [];
                return $cartItem;
            });

        if ($cartItems->isEmpty()) {
            return redirect()->route('paywall.cart')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $transportFees = [
            'store_pickup' => 0,
            'standard_delivery' => 5,
            'speedy_delivery' => 10,
        ];
        $fee = $transportFees[$shipping['transport_option']] ?? 0;

        $order = Order::create([
            'user_id' => $userId,
            'first_name' => $invoice['first_name'],
            'last_name' => $invoice['last_name'],
            'email' => $invoice['email'],
            'address' => $invoice['address'],
            'city' => $invoice['city'],
            'zip_code' => $invoice['zip_code'],
            'country' => $invoice['country'],
            'transport_option' => $shipping['transport_option'],
            'payment_method' => $payment['payment_method'],
            'time_of_order' => now(),
            'state_of_order' => 'Processing'
        ]);

        foreach ($cartItems as $item) {
            $order->order_items()->create([
                'product_id' => $item->product_id,
                'amount' => $item->amount,
                'selected_variants' => $item->selected_variants,
            ]);
        }

        session()->forget(['checkout.invoice', 'checkout.shipping', 'checkout.payment']);
        if (!auth()->check()) {
            session()->forget('cart');
        } else {
            CartItem::where('user_id', $userId)->delete();
        }

        return redirect()->route('home')->with('order_success', 'Order placed successfully!');
    }
}
