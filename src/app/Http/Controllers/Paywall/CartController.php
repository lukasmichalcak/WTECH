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
            $items = collect($cart)->values();
            $productIds = collect($items)->pluck('product_id')->unique();
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $cartItems = $items->map(function ($entry) use ($products) {
                $cartItem = new CartItem();
                $cartItem->product_id = $entry['product_id'];
                $cartItem->product = $products[$entry['product_id']] ?? null;
                $cartItem->amount = $entry['amount'] ?? 1;
                $cartItem->selected_variants = $entry['selected_variants'] ?? [];
                return $cartItem;
            });

            Log::debug($cartItems);
            $total = $cartItems->sum(fn($item) => $item->amount * ($item->product->price ?? 0));
        }

        return view('paywall.cart', [
            'cartItems' => $cartItems,
            'cartTotal' => $total
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'selected_variants' => 'required|array',
        ]);

        $data['amount'] = 1;
        $product = Product::findOrFail($data['product_id']);
        $normalizedVariants = normalizeVariants($data['selected_variants']);

        if (auth()->check()) {
            $existing = CartItem::where('user_id', auth()->id())
                ->where('product_id', $data['product_id'])
                ->get()
                ->first(function ($item) use ($normalizedVariants) {
                    return normalizeVariants($item->selected_variants) === $normalizedVariants;
                });

            if ($existing) {
                if ($existing->amount + 1 > $product->stock) {
                    return response()->json(['success' => false, 'message' => 'Not enough stock.']);
                }

                $existing->increment('amount');
                return response()->json(['success' => true]);
            }

            if ($product->stock < 1) {
                return response()->json(['success' => false, 'message' => 'Out of stock.']);
            }

            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $data['product_id'],
                'selected_variants' => $data['selected_variants'],
                'amount' => 1,
            ]);

            return response()->json(['success' => true, 'newItem' => true]);
        }

        // For guests
        $cart = session()->get('cart', []);
        $key = $data['product_id'] . '::' . $normalizedVariants;

        if (isset($cart[$key])) {
            $cart[$key]['amount'] += 1;
            session(['cart' => $cart]);

            return response()->json(['success' => true]);

        } else {
            if ($product->stock < 1) {
                return response()->json(['success' => false, 'message' => 'Out of stock.']);
            }

            $cart[$key] = [
                'product_id' => $data['product_id'],
                'selected_variants' => $data['selected_variants'],
                'amount' => 1,
            ];
            session(['cart' => $cart]);

            return response()->json(['success' => true, 'newItem' => true]);
        }
    }

    public function increase(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');
        $variantHash = $request->input('variant_hash');
        $compositeKey = "{$productId}::{$variantHash}";

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
        if (isset($cart[$compositeKey]) && $cart[$compositeKey]['amount'] < $product->stock) {
            $cart[$compositeKey]['amount']++;
            session(['cart' => $cart]);
        }

        $productIds = collect($cart)->pluck('product_id')->unique();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $total = collect($cart)->reduce(function ($carry, $entry) use ($products) {
            return $carry + (($entry['amount'] ?? 0) * ($products[$entry['product_id']]->price ?? 0));
        }, 0);

        return response()->json([
            'amount' => $cart[$compositeKey]['amount'] ?? 0,
            'cartTotal' => $total,
        ]);
    }

    public function decrease(Request $request): JsonResponse
    {
        $productId = $request->input('product_id');
        $variantHash = $request->input('variant_hash');
        $compositeKey = "{$productId}::{$variantHash}";

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

        if (isset($cart[$compositeKey])) {
            $cart[$compositeKey]['amount']--;

            if ($cart[$compositeKey]['amount'] <= 0) {
                unset($cart[$compositeKey]);
            }

            session(['cart' => $cart]);

            $productIds = collect($cart)->pluck('product_id')->unique();
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $total = collect($cart)->reduce(function ($carry, $entry) use ($products) {
                return $carry + (($entry['amount'] ?? 0) * ($products[$entry['product_id']]->price ?? 0));
            }, 0);

            return response()->json([
                'removed' => !isset($cart[$compositeKey]),
                'amount' => $cart[$compositeKey]['amount'] ?? 0,
                'cartItemsCount' => count($cart),
                'cartTotal' => $total,
            ]);
        }

        return response()->json(['amount' => 0, 'cartTotal' => 0]);
    }
}
