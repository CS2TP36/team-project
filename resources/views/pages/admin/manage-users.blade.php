@extends('layouts.admin')

@section('title', 'Admin - Manage Users')

@section('content')
    <div class="container">
        <h1>Manage Users</h1>
        <div class="d-flex justify-content-center my-3">
            <a href="#" class="btn btn-primary btn-lg px-4 py-2 fw-bold">
                ➕ Add New User
            </a>
        </div>

        <div class="container mb-4">
            <form method="GET" action="#" class="d-flex align-items-center gap-3">
                <label for="role" class="form-label mb-0">Filter by Role:</label>
                <select id="role" name="role" class="form-select w-auto" onchange="this.form.submit()">

                    <!-- filter for role options -->
                    <option value="all">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="customer">Customer</option>
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

            <!-- Dummy data for now for placeholders -->
            <!-- first person-->
            <tr>
                <td class="text-center">1</td>
                <td>John Smith</td>
                <td>john@smith.com</td>
                <td class="text-center">Admin</td>
                <td class="text-center d-flex justify-content-center gap-2">
                    <a href="#" class="btn btn-sm btn-warning">
                        ✏️ Edit
                    </a>
                    <form action="#" method="POST">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <tr>
                <!-- second person -->
                <td class="text-center">2</td>
                <td>Bruce wayne</td>
                <td>burcee@wayne.com</td>
                <td class="text-center">Customer</td>
                <td class="text-center d-flex justify-content-center gap-2">
                    <a href="#" class="btn btn-sm btn-warning">
                        ✏️ Edit
                    </a>
                    <form action="#" method="POST">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

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

