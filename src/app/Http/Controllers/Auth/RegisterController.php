<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddressDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        // Validation of user input
        $credentials = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'passwordConfirmation' => 'required|same:password',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => ['required', 'regex:/^\d{3}\s?\d{2}$/'],
            'country' => 'required|string|in:Slovakia,Czech Republic,Germany,Other',
        ]);

        try {
            // Use database transaction to ensure both user and address are created or neither
            DB::beginTransaction();

            // Create user first
            $user = User::create([
                'first_name' => $credentials['first_name'],
                'last_name' => $credentials['last_name'],
                'username' => $credentials['username'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
            ]);

            // Create address details with relationship to user
            AddressDetails::create([
                'user_id' => $user->id,
                'address' => $credentials['address'],
                'city' => $credentials['city'],
                'zip_code' => $credentials['zip'],
                'country' => $credentials['country'],
            ]);


            DB::commit();

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }


}
