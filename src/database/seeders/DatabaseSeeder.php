<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AddressDetailsSeeder::class,
            CardDetailsSeeder::class,
            ProductSeeder::class,
            UserFavouriteSeeder::class,
            OrderSeeder::class,
            ShoppingCartSeeder::class,
            AttributeSeeder::class,
            VariantSeeder::class,
            CartAttrVarSeeder::class,
            TagSeeder::class,
        ]);
    }
}
