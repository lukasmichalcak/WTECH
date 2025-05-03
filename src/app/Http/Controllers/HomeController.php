<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class HomeController
{

    public function index()
    {

        // Get products with pagination
        $products = DB::table('products')->paginate(8);

        // For each product, fetch its first image
        foreach ($products as $product) {
            // Get the first image for this product through the pivot table
            $image = DB::table('images')
                ->join('image_product', 'images.id', '=', 'image_product.image_id')
                ->where('image_product.product_id', $product->id)
                ->select('images.path')
                ->first();

            // Assign the image path to the product object
            $product->image_path = $image ? $image->path : 'default-product.png';
        }

        return view('home', compact('products'));
    }


}
