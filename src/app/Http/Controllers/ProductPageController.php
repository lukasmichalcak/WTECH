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


        $tags = DB::table('tags')
            ->join('product_tag', 'tags.id', '=', 'product_tag.tag_id')
            ->where('product_tag.product_id', $product->id)
            ->select('tags.*')
            ->get();


        return view('product-page', compact('product', 'attributes','tags'));

    }

    public function getProductTags($productId)
    {
        // Get all tags for this product in a single query
        $tags = DB::table('tags')
            ->join('product_tag', 'tags.id', '=', 'product_tag.tag_id')
            ->where('product_tag.product_id', $productId)
            ->select('tags.*')
            ->get();

        return $tags;
    }
}
