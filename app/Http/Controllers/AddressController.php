<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $addresses = Address::where('user_id', Auth::id())->get();

        return view('pages.account-addresses', compact('addresses'));
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $address = null;

        return view('pages.edit-address', compact('address'));
    }

    // Handles address form submission and saves data
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'post_code' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'town_city' => 'required|string|max:255',
            'county' => 'nullable|string|max:255',
            'is_default' => 'sometimes|boolean',
        ]);

        if ($request->boolean('is_default')) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'post_code' => $request->post_code,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'town_city' => $request->town_city,
            'county' => $request->county,
            'is_default' => $request->has('is_default') && $request->boolean('is_default'),
        ]);

        return redirect()->route('account.addresses')->with('success', 'Address successfully added.');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('pages.edit-address', compact('address'));
    }
    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('message', 'Please login first.');
        }

        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $address->delete();

        return redirect()->route('account.addresses')->with('success', 'Address deleted successfully.');
    }

    public function update(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect()->route('login.show')->with('message', 'Please login first.');
    }

    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'post_code' => 'required|string|max:20',
        'address_line1' => 'required|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'town_city' => 'required|string|max:255',
        'county' => 'nullable|string|max:255',
        'is_default' => 'required|boolean',
    ]);

    $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    if ($request->boolean('is_default')) {
        Address::where('user_id', Auth::id())->update(['is_default' => false]);
        $address->is_default = true;
    } else {
        // If checkbox is unchecked and it's currently default, reset the default to the first created address
        if ($address->is_default) {
            $address->is_default = false;
            $otherAddress = Address::where('user_id', Auth::id())
                ->where('id', '!=', $address->id)
                ->orderBy('created_at', 'asc')
                ->first();

            if ($otherAddress) {
                $otherAddress->update(['is_default' => true]);
            }
        }
    }

    // update remaining fields
    $address->update([
        'full_name' => $request->full_name,
        'phone_number' => $request->phone_number,
        'post_code' => $request->post_code,
        'address_line1' => $request->address_line1,
        'address_line2' => $request->address_line2,
        'town_city' => $request->town_city,
        'county' => $request->county,
    ]);

    return redirect()->route('account.addresses')->with('success', 'Address successfully updated.');
}
}