<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Laptop' => ['Ultrabook', 'Gaming', 'Business', '2-in-1'],
            'Phone' => ['Flagship', 'Budget', 'Foldable', 'Gaming'],
            'Tablet' => ['Standard', 'Pro', 'Drawing Tablet'],
            'Monitor' => ['4K', 'Gaming', 'Ultrawide', 'Curved'],
            'Smartwatch' => ['Fitness', 'Luxury', 'Kids', 'Sports'],
            'Desktop' => ['Gaming PC', 'Workstation', 'Mini PC'],
            'Router' => ['WiFi 5', 'WiFi 6', 'Mesh System'],
        ];

        $type = $this->faker->randomElement(array_keys($types));
        $subtype = $this->faker->randomElement($types[$type]);

        return [
            'name' => $this->generateProductName(),
            'description' => $this->faker->paragraph(),
            'type' => $type,
            'subtype' => $subtype,
            'price' => $this->faker->randomFloat(2, 199, 2999),
            'stock' => $this->faker->numberBetween(0, 100),
            'brand' => $this->faker->randomElement(['ASUS', 'Apple', 'Dell', 'Samsung', 'HP', 'Lenovo']),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function ($product) {
            Attribute::factory()
                ->count(rand(2, 5))
                ->create([
                    'product_id' => $product->id,
                ]);

            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $product->tags()->attach($tags);
        });
    }

    public function generateProductName(): string
    {
        $prefixes = ['Power', 'Zen', 'Tech', 'Cyber', 'Hyper', 'Neo', 'Logic', 'Alpha', 'Quantum', 'Pixel', 'Fusion', 'Glide', 'Pulse', 'Cloud', 'Orbit'];
        $nouns = ['Pad', 'Book', 'Box', 'Station', 'Drive', 'Watch', 'Phone', 'Tab', 'Dock', 'Chip', 'Frame', 'Beam', 'Node', 'Gear', 'Stick'];
        $adjectives = ['Ultra', 'Pro', 'Max', 'Lite', 'Mini', 'Nano', 'Prime', 'Edge', 'Air', 'Core', 'Smart', 'Plus', 'Go', 'X', 'Flex'];

        return collect([
            fake()->randomElement($prefixes),
            fake()->randomElement($nouns),
            fake()->optional()->randomElement($adjectives), // sometimes add a third word
        ])->filter()->implode(' ');
    }
}
