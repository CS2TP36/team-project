<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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

}
