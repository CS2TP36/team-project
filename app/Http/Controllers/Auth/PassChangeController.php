<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PassChangeController extends Controller
{
    public function show() {
        // if not logged in goes to login
        if (!Auth::check()){
            return redirect('/login');
        }
        // if logged in go to change pass page
        return view('pages.change-pass');
    }
    public function change(Request $request) {
        // check again if logged in
        if (!Auth::check()){
            return redirect('/login');
        }
        // validate the passwords
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);
        // gets the current user
        $user = Auth::user();
        // changes the password
        $user['password'] = Hash::make($validated['password']);
        return back()->withErrors('passChange', 'Something went wrong');
    }
}
