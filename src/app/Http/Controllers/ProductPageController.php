<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function show($id)
    {

//        Loading product
        $product = DB::table('products')->where('id', $id)->first();


        if (!$product) {
            abort(404);
        }


        $attributes = DB::table('attributes')->where('product_id', $id)->get();

        // Get variants for each attribute
        foreach ($attributes as $attribute) {

            $attribute->variants = DB::table('variants')
                ->where('attribute_id', $attribute->id)
                ->get();
        }

        // Loading first 4 images for the product
        $images = DB::table('images')
            ->join('image_product', 'images.id', '=', 'image_product.image_id')
            ->where('image_product.product_id', $id)
            ->select('images.*')
//            ->limit(4)
            ->get();

//        return view('product-page', compact('product', 'attributes'));
        return view('product-page', compact('product', 'attributes', 'images'));

    }
}
