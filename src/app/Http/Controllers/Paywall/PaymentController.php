<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('paywall.payment');
    }
}
