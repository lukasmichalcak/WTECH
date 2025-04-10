<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|email', // no spaces
            'password' => 'required',
        ]);

        $loginData = [
            'email' => $credentials['username'], // map 'username' input to 'email' column
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


}
