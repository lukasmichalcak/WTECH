<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CardDetails;

class CardDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CardDetails::create([
            'user_id' => UserSeeder::$userId,
            'number' => '1234 5678 9012 3456',
            'expiration_date' => '10/28',
            'cv' => '111',
        ]);
    }
}
