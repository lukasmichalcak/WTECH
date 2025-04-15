<?php

namespace App\Http\Controllers\Header;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function profile()
    {
        return view('profile.profile');
    }

    public function orders()
    {
        return view('profile.orders');
    }
}
