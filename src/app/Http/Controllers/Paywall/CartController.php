<?php

namespace App\Http\Controllers\Paywall;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function cart()
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

        return view('paywall.cart',[
            'cartItems' => $cartItems,
            'cartTotal' => $total
            ]);
    }

    public function increase(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        if (auth()->check()) {
            $item = CartItem::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($item && $item->amount < $product->stock) {
                $item->amount++;
                $item->save();
            }

            $total = CartItem::where('user_id', auth()->id())
                ->with('product')
                ->get()
                ->sum(fn($i) => $i->amount * $i->product->price);

            return response()->json([
                'amount' => $item->amount,
                'cartTotal' => $total,
            ]);
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$productId]) && $cart[$productId]['amount'] < $product->stock) {
            $cart[$productId]['amount']++;
            session()->put('cart', $cart);
        }

        $productIds = array_keys($cart);
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $total = collect($cart)->reduce(function ($carry, $entry, $id) use ($products) {
            return $carry + (($entry['amount'] ?? 0) * ($products[$id]->price ?? 0));
        }, 0);

        return response()->json([
            'amount' => $cart[$productId]['amount'] ?? 0,
            'cartTotal' => $total,
        ]);
    }

    public function decrease(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');

        if (auth()->check()) {
            $item = CartItem::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($item) {
                $item->amount--;

                if ($item->amount <= 0) {
                    $item->delete();
                    $newCount = CartItem::where('user_id', auth()->id())->count();

                    $total = CartItem::where('user_id', auth()->id())
                        ->with('product')
                        ->get()
                        ->sum(fn($i) => $i->amount * $i->product->price);

                    return response()->json([
                        'removed' => true,
                        'cartItemsCount' => $newCount,
                        'cartTotal' => $total,
                    ]);
                }

                $item->save();

                $total = CartItem::where('user_id', auth()->id())
                    ->with('product')
                    ->get()
                    ->sum(fn($i) => $i->amount * $i->product->price);

                return response()->json([
                    'amount' => $item->amount,
                    'cartTotal' => $total,
                ]);
            }
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['amount']--;

            if ($cart[$productId]['amount'] <= 0) {
                unset($cart[$productId]);
                session()->put('cart', $cart);

                $newCount = count($cart);

                $productIds = array_keys($cart);
                $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

                $total = collect($cart)->reduce(function ($carry, $entry, $id) use ($products) {
                    return $carry + (($entry['amount'] ?? 0) * ($products[$id]->price ?? 0));
                }, 0);

                return response()->json([
                    'removed' => true,
                    'cartItemsCount' => $newCount,
                    'cartTotal' => $total,
                ]);
            }

            session()->put('cart', $cart);

            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $total = collect($cart)->reduce(function ($carry, $entry, $id) use ($products) {
                return $carry + (($entry['amount'] ?? 0) * ($products[$id]->price ?? 0));
            }, 0);

            return response()->json([
                'amount' => $cart[$productId]['amount'],
                'cartTotal' => $total,
            ]);
        }

        return response()->json(['amount' => 0, 'cartTotal' => 0]);
    }
}
