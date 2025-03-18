<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageUsersController extends Controller
{
    // function to check if the user is allowed to manage users
    private function allowed(): bool
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    // function to show the manage users page
    public function show(Request $request)
    {
        if (!$this->allowed()) {
            return redirect('/home')->with('message', 'You are not allowed to manage users');
        }

        // Fetches users and filter by role
        $query = User::query();
        if ($request->has('role') && in_array($request->role, ['admin', 'customer'])) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('id')->get();
        return view('pages.admin.manage-users', compact('users'))->with('role', $request->role ?? 'all');
    }

    // function to update user role
    public function updateRole(Request $request, $id)
    {
        if (!$this->allowed()) {
            return redirect('/home')->with('message', 'You are not allowed to manage users');
        }

        $request->validate([
            'role' => 'required|string|in:admin,customer',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.manage-users')->with('success', 'User role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevents admins from deleting themselves
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.manage-users')->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return redirect()->route('admin.manage-users')->with('success', 'User deleted successfully.');
    }
}