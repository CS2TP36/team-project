<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Store a new user in the database.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|regex:/^\+44\d{10,13}$/',
            'address' => 'required|string|max:255',
        ]);

        // Create the user in the database
        $user = User::create([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone_number' => $validated['phone'],
            'home_address' => $validated['address'],
            'postcode' => '', // Add if applicable or leave empty
            'role' => 'user', // Default role
        ]);

        // Log the user in or redirect to the login page
        //auth()->login($user);

        // Redirect to a success page or dashboard
        return redirect('/home')->with('success', 'Registration successful!');    }
}

