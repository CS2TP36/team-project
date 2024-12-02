<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function show(){
        $userid = Session::get('user_id');
        // if not logged in redirect to login
        if ($userid == null){
            return redirect('/login');
        }
        // otherwise go to account page with user passed as a variable
        $user = User::all()->where('id', $userid)->first();
        return view('pages.account', ['user' => $user]);
    }
}
