<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class AccountController extends Controller
{
    public function show($page = 'account')
    {
        // Checks if user is logged in
        if (!Auth::check()) {
            return redirect('/login/account');
        }

        // Retrieves the user 
        $user = Auth::user();
        // checks which page to return
        return match ($page) {
            'orders' => redirect()->route('previous-orders.show'),
            'details' => view('pages.contact-details', ['user' => $user]),
            'addresses' => view('pages.account-addresses', ['user' => $user]),
            default => view('pages.account', ['user' => $user]),
        };
    }

    // Updates user details
    function update(Request $request) {
        // checks if user is logged in
        if (!Auth::check()) {
            return back()->with('message', 'You are not logged in');
        }
        // validates the request
        $request->validate([
            'first-name' => 'required|string',
            'last-name' => 'required|string',
            'email' => 'required|email',
            'phone-number' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            // updates the user's details
            $user = Auth::user();
            $user['first_name'] = $request->input('first-name');
            $user['last_name'] = $request->input('last-name');
            $user['email'] = $request->input('email');
            $user['phone_number'] = $request->input('phone-number');
            $user->save();
            // tells the user it was successful
            DB::commit();
            return back()->with('message', 'Your information has been updated');
            // catches error and rolls changes back if so
        } catch (Error $e) {
            DB::rollBack();
            // tells the user it was unsuccessful
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.show')->with('error', 'You must be logged in to delete your account.');
        }

        // Logs the user out before deleting
        Auth::logout();

        $user->addresses()->delete(); // Deletes all user addresses
        $user->orders()->delete(); // Deletes all user orders
        $user->reviews()->delete(); // Deletes all user reviews
        $user->wishlistItems()->delete(); // Deletes all wishlist items
        $user->basketItems()->delete(); // Deletes all basket items
        $user->delete(); // Delete user account
  

        // Redirects user to home page with success message
        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }

}
