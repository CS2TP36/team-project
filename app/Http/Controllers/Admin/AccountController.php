<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    function show() {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return back()->with('message', 'You do not have permission to access this page');
        }
        return view('pages.admin.account');
    }
}
