<?php

namespace Database\Seeders;

use App\Models\AddressDetails;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public static string $orderId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = Order::create([
            'first_name' => 'Maros',
            'last_name' => 'Guran',
            'email' => 'maros@skrupulus.com',
            'address' => 'Guran Street 20',
            'city' => 'Martin',
            'zip_code' => '91708',
            'country' => 'Slovakia',
            'transport_option' => 'speedy delivery',
            'payment_method' => 'card',
            'time_of_order' => now(),
            'state_of_order' => 'processing',
        ]);

        self::$orderId = $order->id; // stores the order for seeding
    }
}
