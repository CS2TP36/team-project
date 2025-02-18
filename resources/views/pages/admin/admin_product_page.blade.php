@extends('layouts.admin')

@section('title', 'Admin - Product Management')

@section('content')
    <div class="container">
        <h1>Product Management</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            {{ $product->name }}
                            @if ($product->images->isNotEmpty())
                                <img src="{{ asset('images/productImage/' . $product->images->first()->image_name) }}" width="50">
                            @endif
                        </td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-4') }}
</div>
    </div>
@endsection
