<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//use newrelic\DistributedTracePayload;

class ProductNewController extends Controller
{
    public function show()
    {

        // Store all unique brands
        $brands = DB::table('products')
            ->select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->pluck('brand')
            ->toArray();

        return view('product-page-new', compact('brands'));
    }

    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' ,
            'type' => 'required|string|max:255',
            'subtype' => 'required|string|max:255',
        ]);


        $productId = Str::uuid();
        DB::table('products')->insert([
            'id' => $productId,
            'name' => $validated['name'],
            'brand' => $validated['brand'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'created_at' => now(),
            'updated_at' => now(),
            'type' => $validated['type'],
            'subtype' => $validated['subtype']
        ]);


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();


                $image->move(public_path('resources/images'), $filename);


                $imageId = Str::uuid();
                DB::table('images')->insert([
                    'id' => $imageId,
                    'path' => $filename,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);


                DB::table('image_product')->insert([
                    'product_id' => $productId,
                    'image_id' => $imageId
                ]);
            }
        }

        return redirect()->route('product.admin', ['id' => $productId])
            ->with('success', 'Product successfully created 🎉');
    }


}
