@extends('layouts.admin')

@section('title', 'Admin - Manage Users')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>
        <div class="container mb-4">
            <form method="GET" action="{{ route('admin.manage-users') }}" class="d-flex align-items-center gap-3">
                <label for="role" class="form-label mb-0">Filter by Role:</label>
                <select id="role" name="role" class="form-select w-auto" onchange="this.form.submit()">
                    <!-- filter for role options -->
                    <option value="all" @if($role === "all") selected @endif>All Roles</option>
                    <option value="admin" @if($role === "admin") selected @endif>Admin</option>
                    <option value="customer" @if($role === "customer") selected @endif>Customer</option>
                </select>
            </form>
        </div>

        <table class="table table-striped table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                            <form method="POST" action="{{ route('admin.update-role', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="role" class="form-select" onchange="this.form.submit()">
                                    <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                                    <option value="customer" @if($user->role === 'customer') selected @endif>Customer</option>
                                </select>
                            </form>
                        </td>
                        <td class="text-center d-flex justify-content-center gap-2">
                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE') <!-- Ensure DELETE request -->
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">

            <!-- page navigation -->
            <nav aria-label="Page navigation">
                <ul class="page navination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <!-- buttons don't work just yet -->
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

