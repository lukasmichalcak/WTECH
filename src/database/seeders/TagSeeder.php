<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Product;
use Database\Seeders\ProductSeeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag1 = Tag::create([
            'name' => 'Tag 1',
        ]);

        $tag2 = Tag::create([
            'name' => 'Tag 2',
        ]);

        $tag3 = Tag::create([
            'name' => 'Tag 3',
        ]);

        $product = Product::find(ProductSeeder::$productId);
        $product->tags()->attach([$tag1->id, $tag2->id, $tag3->id]);
    }
}
