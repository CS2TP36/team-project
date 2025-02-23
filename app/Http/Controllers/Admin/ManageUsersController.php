<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUsersController extends Controller
{
    // function to check if the user is allowed to manage users
    private function allowed(): bool {
        // TODO: needs to check if user has permission to manage users first
        return true;
    }
    // function to show the manage users page
    function show() {
        // if not allowed redirect to home
        if (!$this->allowed()) {
            return redirect('/home')->with('message', 'You are not allowed to manage users');
        }
        // return the page with all the users
        $users = User::all()->sortBy('id');
        return view('pages.admin.manage-users', ['users' => $users]);
    }

}
