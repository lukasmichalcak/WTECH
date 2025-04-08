<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public static string $userId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'maros',
            'last_name' => 'guran',
            'username' => 'mahosko',
            'email' => 'maros@skrupulus.com',
            'password' => Hash::make('mahosko'),
        ]);

        self::$userId = $user->id; // stores the user for seeding
    }
}
