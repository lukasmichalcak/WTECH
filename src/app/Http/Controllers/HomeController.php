<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class HomeController
{
    public function index()
    {
        $products = DB::table('products')->paginate(8);

        foreach ($products as $product) {
            $image = DB::table('images')
                ->join('image_product', 'images.id', '=', 'image_product.image_id')
                ->where('image_product.product_id', $product->id)
                ->select('images.path')
                ->first();

            $product->image_path = $image ? $image->path : 'default-product.png';
        }

        // Get distinct types and brands
        $types = DB::table('products')->distinct()->pluck('type');
        $sidebar = [];

        foreach ($types as $type) {
            $brands = DB::table('products')
                ->where('type', $type)
                ->distinct()
                ->pluck('brand');

            $sidebar[$type] = $brands;
        }

        return view('home', compact('products', 'sidebar'));
    }

}
