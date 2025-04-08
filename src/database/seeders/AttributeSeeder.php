<?php

namespace Database\Seeders;

use Dom\Attr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public static string $attributeId;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attribute = Attribute::create([
            'product_id' => ProductSeeder::$productId,
            'name' => 'ram',
        ]);

        self::$attributeId = $attribute->id; // stores the attribute for seeding
    }
}
