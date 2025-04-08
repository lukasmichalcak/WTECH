<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Variant;

class VariantSeeder extends Seeder
{
    public static string $variantId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variant = Variant::create([
            'attribute_id' => AttributeSeeder::$attributeId,
            'name' => '16GB',
        ]);

        Variant::create([
            'attribute_id' => AttributeSeeder::$attributeId,
            'name' => '24GB',
        ]);

        Variant::create([
            'attribute_id' => AttributeSeeder::$attributeId,
            'name' => '32GB',
        ]);

        self::$variantId = $variant->id; // stores the variant for seeding
    }
}
