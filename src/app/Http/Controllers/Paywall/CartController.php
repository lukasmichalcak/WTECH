<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('paywall.cart');
    }
}
