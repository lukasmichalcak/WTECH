<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Tag;
use App\Models\AddressDetails;
use App\Models\CardDetails;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Maroš',
            'last_name' => 'Guráň',
            'username' => 'mahosko',
            'email' => 'maros@skrupulus.com',
            'password' => Hash::make('mahosko'),
        ]);

        $userId = $user->id;

        AddressDetails::factory()->count(1)->create([
            'user_id' => $user->id,
        ]);

        CardDetails::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        User::factory()->count(9)->create();
        Tag::factory()->count(80)->create();
        Product::factory()->count(50)->create();
    }
}
