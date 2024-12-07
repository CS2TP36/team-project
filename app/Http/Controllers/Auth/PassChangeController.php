<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
}
