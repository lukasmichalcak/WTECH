<?php

namespace App\Http\Controllers\Paywall;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoice()
    {
        return view('paywall.invoice');
    }
}
