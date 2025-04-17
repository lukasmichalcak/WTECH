<?php

namespace App\Http\Controllers\UserDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function updateName(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $user->update($validated);

        echo $user;

        return redirect()->back()->with('success', 'Name updated.');
    }

    public function updateAddress(Request $request, $id)
    {
        $user = auth()->user();
        $addresses = $user->address_details;

        $address = $addresses->firstWhere('id', $id);

        if (!$address) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $address->update($validated);

        return redirect()->back()->with('success', 'Address updated.');
    }

    public function deleteAddress($id)
    {
        $user = auth()->user();
        $addresses = $user->address_details;

        if ($addresses->count() <= 1) {
            return redirect()->back()->with('error', 'You must have at least one address.');
        }

        $address = $addresses->firstWhere('id', $id);

        if (!$address) {
            return redirect()->back()->with('error', 'Address not found.');
        }

        $address->delete();

        return redirect()->back()->with('success', 'Address deleted.');
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $user = auth()->user();
        $user->address_details()->create($validated);

        return redirect()->back()->with('success', 'Address created.');
    }

    public function updateCard(Request $request, $id)
    {
        $user = auth()->user();
        $cards = $user->card_details;

        $card = $cards->firstWhere('id', $id);

        if (!$card) {
            return redirect()->back()->with('error', 'Card not found.');
        }

        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'expiration_date' => 'required|string|max:100',
            'cv' => 'required|string|min:3|max:3',
        ]);

        $card->update($validated);

        return redirect()->back()->with('success', 'Card updated.');
    }

    public function deleteCard($id)
    {
        $user = auth()->user();
        $cards = $user->card_details;

        if ($cards->count() <= 1) {
            return redirect()->back()->with('error', 'You must have at least one card.');
        }

        $card = $cards->firstWhere('id', $id);

        if (!$card) {
            return redirect()->back()->with('error', 'Card not found.');
        }

        $card->delete();

        return redirect()->back()->with('success', 'Card deleted.');
    }

    public function storeCard(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'expiration_date' => 'required|string|max:100',
            'cv' => 'required|string|min:3|max:3',
        ]);

        $user = auth()->user();
        $user->card_details()->create($validated);

        return redirect()->back()->with('success', 'Card created.');
    }
}
