<?php

namespace App\Http\Controllers\Header;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $address_details = $user->address_details()->orderBy('created_at')->orderBy('id')->get();
        $card_details = $user->card_details()->orderBy('created_at')->orderBy('id')->get();

        return view('profile.profile', [
            'user' => $user,
            'address_details' => $address_details,
            'card_details' => $card_details]);
    }

    public function orders()
    {
        return view('profile.orders');
    }
}
