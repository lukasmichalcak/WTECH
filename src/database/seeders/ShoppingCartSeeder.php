<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItems;

class ShoppingCartSeeder extends Seeder
{
    public static string $cartId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cart = OrderItems::create([
            'user_id' => UserSeeder::$userId,
            'order_id' => OrderSeeder::$orderId,
            'product_id' => ProductSeeder::$productId,
            'amount' => 69,
        ]);

        self::$cartId = $cart->id; // stores the cart for seeding
    }
}
