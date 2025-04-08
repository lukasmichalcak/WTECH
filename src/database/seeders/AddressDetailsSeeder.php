<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AddressDetails;

class AddressDetailsSeeder extends Seeder
{
    public static string $addressDetailsId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addressDetails = AddressDetails::create([
            'user_id' => UserSeeder::$userId,
            'address' => 'Guran Street 20',
            'city' => 'Martin',
            'zip_code' => '91708',
            'country' => 'Slovakia',
        ]);

        self::$addressDetailsId = $addressDetails->id; // stores the addressDetails for seeding
    }
}
