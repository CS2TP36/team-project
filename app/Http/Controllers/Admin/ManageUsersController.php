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
    function show(Request $request) {
        // if not allowed redirect to home
        if (!$this->allowed()) {
            return redirect('/home')->with('message', 'You are not allowed to manage users');
        }
        // get all the users
        $users = User::all()->sortBy('id');
        // if a role is specified filter the users
        if ($request) {
            $request->validate([
                'role' => 'required|string|in:admin,customer,all'
            ]);
            if ($request['role'] != 'all') {
                $users = $users->where('role', $request['role']);
            }
        }
        // return the page with the required users
        return view('pages.admin.manage-users', ['users' => $users, 'role' => $request['role'] ?? 'all']);
    }
}
