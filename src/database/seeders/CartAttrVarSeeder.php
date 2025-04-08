<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CartAttrVar;

class CartAttrVarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CartAttrVar::create([
            'cart_id' => ShoppingCartSeeder::$cartId,
            'attribute_id' => AttributeSeeder::$attributeId,
            'variant_id' => VariantSeeder::$variantId,
        ]);
    }
}
