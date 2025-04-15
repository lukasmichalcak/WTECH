<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Variant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    /**
     * Shared attribute definitions.
     *
     * @var array<string, string[]>
     */
    private static array $attributeVariants = [
        "Color" => ["Black", "White", "Silver", "Space Gray", "Midnight Blue"],
        "RAM" => ["4GB", "8GB", "16GB", "32GB", "64GB"],
        "Storage" => ["128GB", "256GB", "512GB", "1TB", "2TB"],
        "Processor" => ["Intel i5", "Intel i7", "Intel i9", "M1", "M2", "AMD Ryzen 7"],
        "Operating System" => ["Windows 11", "macOS Ventura", "Linux", "Android 14"],
        "Display Size" => ['13"', '14"', '15.6"', '16"', '17.3"'],
        "Graphics Card" => ["Intel Iris Xe", "NVIDIA RTX 3050", "RTX 3060", "AMD Radeon"],
        "Screen Type" => ["LCD", "LED", "OLED", "Retina", "IPS"],
        "Resolution" => ["HD", "Full HD (1920x1080)", "QHD", "4K (3840x2160)"],
        "Battery Life" => ["Up to 6h", "8h", "10h", "12h"],
        "Weight" => ["1.2kg", "1.5kg", "2.0kg"],
        "Connectivity" => ["WiFi 6", "Bluetooth 5.0", "5G", "NFC"],
        "Ports" => ["USB-C", "Thunderbolt", "HDMI", "SD Card"],
        "Keyboard Type" => ["Backlit", "Mechanical", "Chiclet", "RGB"],
        "Touchscreen" => ["Yes", "No"],
        "Material" => ["Aluminum", "Plastic", "Magnesium Alloy"],
        "Warranty" => ["1 Year", "2 Years", "3 Years"]
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $attributeName = $this->faker->randomElement(array_keys(self::$attributeVariants));

        return [
            'product_id' => Product::factory(),
            'name' => $attributeName,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function ($attribute) {
            $variants = self::$attributeVariants[$attribute->name] ?? [];

            foreach ($variants as $value) {
                Variant::create([
                    'attribute_id' => $attribute->id,
                    'name' => $value,
                ]);
            }
        });
    }
}
