<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        // Uses laravel Auth to check if the user is logged in
        if (!Auth::check()) {
            return redirect('/login/account');
        }

        // Retrieves the user from the Auth
        $user = Auth::user();

        // Passes user to view
        return view('pages.account', ['user' => $user]);
    }
}
