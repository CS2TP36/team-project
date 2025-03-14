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
        // Uses laravel Auth to check if the user is logged in
        if (!Auth::check()) {
            return redirect('/login/account');
        }

        // Retrieves the user from the Auth
        $user = Auth::user();
        // check which page to return
        return match ($page) {
            'orders' => redirect()->route('previous-orders.show'),
            'details' => view('pages.contact-details', ['user' => $user]),
            'addresses' => view('pages.account-addresses', ['user' => $user]),
            default => view('pages.account', ['user' => $user]),
        };
    }

    // used to update account details (non-password)
    function update(Request $request) {
        // check if user is logged in
        if (!Auth::check()) {
            return back()->with('message', 'You are not logged in');
        }
        // validate the request
        $request->validate([
            'first-name' => 'required|string',
            'last-name' => 'required|string',
            'email' => 'required|email',
            'phone-number' => 'required|string'
        ]);

        try {
            DB::beginTransaction();
            // update the user's details
            $user = Auth::user();
            $user['first_name'] = $request->input('first-name');
            $user['last_name'] = $request->input('last-name');
            $user['email'] = $request->input('email');
            $user['phone_number'] = $request->input('phone-number');
            $user->save();
            // tell the user it was successful
            DB::commit();
            return back()->with('message', 'Your information has been updated');
        } catch (Error $e) {
            DB::rollBack();
            // tell the user it was unsuccessful
            return back()->with('error', $e->getMessage());
        }
    }

}
