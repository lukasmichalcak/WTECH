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
        session()->forget('checkout');

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $loginData = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($loginData)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->intended('/products-list');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


}
