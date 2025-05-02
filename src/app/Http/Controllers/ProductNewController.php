<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductNewController extends Controller
{
    // Show method to display the page
    public function show($id)
    {

        return view('product-new.show', ['id' => $id]); // or ['product' => $product]
    }
}
