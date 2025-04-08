<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserFavourite;

class UserFavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserFavourite::create([
            'user_id' => UserSeeder::$userId,
            'product_id' => ProductSeeder::$productId,
        ]);
    }
}
