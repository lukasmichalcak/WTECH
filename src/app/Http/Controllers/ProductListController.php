<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductListController
{
    public function show(Request $request)
    {

        $searchTerm = $request->input('search');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $brand = $request->input('brand');
        $minStock = $request->input('minStock');
        $sort = $request->input('sort'); // or $request->sort
        $type = $request->input('type');


        // Base query
        $baseQuery = DB::table('products')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->when($minPrice, function ($query, $minPrice) {
                return $query->where('price', '>=', $minPrice);
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($maxPrice, function ($query, $maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            ->when($brand, function ($query, $brand) {
                return $query->where('brand', 'like', '%' . $brand . '%');
            })
            ->when($minStock, function ($query, $minStock) {
                return $query->where('stock', '>=', $minStock);
            });


        if ($sort === 'asc') {
            $baseQuery->orderBy('name', 'asc'); // Sort A-Z
        } elseif ($sort === 'desc') {
            $baseQuery->orderBy('name', 'desc'); // Sort Z-A
        }

        // Pagination
        $products = (clone $baseQuery)
            ->paginate(12)
            ->appends($request->only(['search', 'minPrice', 'maxPrice', 'brand']));



        // Store all unique brands
//        $brands = (clone $baseQuery)
//            ->select('brand')
//            ->distinct()
//            ->whereNotNull('brand')
//            ->pluck('brand')
//            ->toArray();

        // Store all unique brands
        $brands = DB::table('products')
            ->select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->pluck('brand')
            ->toArray();


        // For each product, fetch its first image
        foreach ($products as $product) {
            // Get the first image for this product through the pivot table
            $image = DB::table('images')
                ->join('image_product', 'images.id', '=', 'image_product.image_id')
                ->where('image_product.product_id', $product->id)
                ->select('images.path')
                ->whereNull('images.deleted_at')
                ->first();

            // Assign the image path to the product object
            $product->image_path = $image ? $image->path : 'default-product.png';
        }



        return view('products-list', compact('products', 'brands'));

    }
}
