<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
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
            ->whereNull('images.deleted_at')
//            ->limit(4)
            ->get();



        // Store all unique brands
        $brands = DB::table('products')
            ->select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->pluck('brand')
            ->toArray();


        return view('product-page-admin', compact('product', 'attributes', 'images', 'brands'));

    }

    public function update(Request $request, $id)
    {
        // Validation of input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'brand' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // max 2MB
        ]);



        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate unique name
                $fileName = uniqid() . '_' . $image->getClientOriginalName();

                // Store to public/resources/images
                $destinationPath = public_path('resources/images');
                $image->move($destinationPath, $fileName);

                $uuid = (string) Str::uuid();

                // Save image info to DB
                DB::table('images')->insert([
                    'id' => $uuid,
                    'path' => $fileName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Link image to product
                DB::table('image_product')->insert([
                    'product_id' => $id,
                    'image_id' => $uuid,
                ]);
            }
        }


        DB::table('products')
            ->where('id', $id)
            ->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'brand' => $validated['brand'],
            ]);

        // Presmerovanie späť s úspešnou správou
        return redirect()->back()->with('success', 'Product name updated successfully!');
    }

    public function deleteImage(Request $request)
    {
        $imageId = $request->input('image_id');

        // Soft delete
        DB::table('images')->where('id', $imageId)->update(['deleted_at' => now()]);

        return back()->with('success', 'Image deleted.');
    }

    public function destroy($id)
    {
        // Delete variants tied to attributes (if your DB has them)
        $attributeIds = DB::table('attributes')
            ->where('product_id', $id)
            ->pluck('id');

        DB::table('variants')
            ->whereIn('attribute_id', $attributeIds)
            ->delete();

        // Delete attributes tied to this product
        DB::table('attributes')
            ->where('product_id', $id)
            ->delete();

        // Get all image IDs linked to this product
        $imageIds = DB::table('image_product')
            ->where('product_id', $id)
            ->pluck('image_id');

        // Delete image records
        DB::table('images')
            ->whereIn('id', $imageIds)
            ->delete();

        // Delete pivot entries
        DB::table('image_product')
            ->where('product_id', $id)
            ->delete();

        // Finally, delete the product
        DB::table('products')
            ->where('id', $id)
            ->delete();

        return redirect()->route('home')->with('success', 'Product and all related data were deleted.');
    }



}
