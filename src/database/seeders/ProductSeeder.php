<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public static string $productId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::create([
            'name' => 'MacBook',
            'type' => 'Computers',
            'subtype' => 'Laptop',
            'price' => '3000$',
            'stock' => '69',
            'brand' => 'Apple',
        ]);

        self::$productId = $product->id; // stores the product for seeding
    }
}
