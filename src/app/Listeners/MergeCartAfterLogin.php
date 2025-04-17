<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\CartItem;

class MergeCartAfterLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionCart = session('cart', []);

        foreach ($sessionCart as $productId => $data) {
            $normalizedVariants = normalizeVariants($data['selected_variants']);

            $existing = CartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->get()
                ->first(function ($item) use ($normalizedVariants) {
                    return normalizeVariants($item->selected_variants) === $normalizedVariants;
                });


            if ($existing && $existing->amount) {
                Log::debug($existing->amount);
                $existing->update([
                    'amount' => max($existing->amount, $data['amount']),
                ]);
            } else {
                CartItem::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'amount' => $data['amount'],
                    'selected_variants' => $data['selected_variants'],
                ]);
            }
        }

        // Clear session cart after merge
        session()->forget('cart');
    }
}
