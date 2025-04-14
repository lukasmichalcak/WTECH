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
            'description' => 'The MacBook Pro 14" M4 Pro (2024) in Space Black delivers top-tier performance with the powerful M4 Pro chip. Its 14.2" Liquid Retina XDR display offers stunning visuals, while the sleek Space Black design adds a premium touch. With long battery life and pro-level efficiency, it\'s perfect for work and creativity.',
            'type' => 'Computers',
            'subtype' => 'Laptop',
            'price' => '3000$',
            'stock' => '69',
            'brand' => 'Apple',
        ]);

        self::$productId = $product->id; // stores the product for seeding
    }
}
