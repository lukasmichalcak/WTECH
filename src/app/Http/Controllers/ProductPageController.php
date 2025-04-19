<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function show($id)
    {

        $product = DB::table('products')->where('id', $id)->first();


        if (!$product) {
            abort(404);
        }

        $attributes = DB::table('attributes')->where('product_id', $id)->get();

        // Get variants for each attribute
        foreach ($attributes as $attribute) {
            // Assuming you have a variants table with attribute_id column
            $attribute->variants = DB::table('variants')
                ->where('attribute_id', $attribute->id)
                ->get();
        }

        return view('product-page', compact('product', 'attributes'));

    }
}
