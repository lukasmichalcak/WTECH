<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function shipping()
    {
        return view('paywall.shipping');
    }
}
