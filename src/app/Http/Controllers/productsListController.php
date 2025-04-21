<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class productsListController
{
    public function show(Request $request)
    {

        $searchTerm = $request->input('search');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $brand = $request->input('brand');
        $minStock = $request->input('minStock');

        // Base query
        $baseQuery = DB::table('products')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->when($minPrice, function ($query, $minPrice) {
                return $query->where('price', '>=', $minPrice);
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

        // Pagination
        $products = (clone $baseQuery)
            ->paginate(12)
            ->appends($request->only(['search', 'minPrice', 'maxPrice', 'brand']));

        // Store all unique brands
        $brands = (clone $baseQuery)
            ->select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->pluck('brand')
            ->toArray();


        return view('products-list', compact('products', 'brands'));
    }
}
