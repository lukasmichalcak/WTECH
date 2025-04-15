<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
class ProductController extends Controller
{
    public function show($id)
    {
        // Try to find the product by ID from the 'products' table
        // If not found, Laravel will automatically return a 404 page
        $product = Product::findOrFail($id);

        // Render a Blade view at 'resources/views/product/detail.blade.php'
        // and pass the product to it
        return view('product.detail', compact('product'));
    }
}
