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

        foreach ($sessionCart as $key => $data) {
            [$productId, $variantSignature] = explode('::', $key);

            Log::debug($variantSignature);

            $existing = CartItem::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->get()
                ->first(function ($item) use ($variantSignature) {
                    Log::debug(normalizeVariants($item->selected_variants));
                    return normalizeVariants($item->selected_variants) === $variantSignature;
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

        session()->forget('cart');
    }
}
