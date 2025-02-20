@extends('layouts.admin')

@section('title', 'Admin - Product Management')

@section('content')
    <div class="container">
        <h1>Product Management</h1>
        <div class="d-flex justify-content-center my-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-lg px-4 py-2 fw-bold">
        ➕ Add New Product
    </a>
</div>
<div class="container mb-4">
    <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex align-items-center gap-3">
        <label for="category" class="form-label mb-0">Filter by Category:</label>
        <select id="category" name="category" class="form-select w-auto" onchange="this.form.submit()">
            <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>
</div>
        <table class="table table-striped table-hover mt-3">
    <thead class="table-dark">
        <tr>
            <th class="text-center">ID</th>
            <th>Name</th>
            <th>Image</th>
            <th class="text-center">Price</th>
            <th class="text-center">Category</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td class="text-center">{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    @if ($product->images->isNotEmpty())
                        <img src="{{ asset('images/productImage/' . $product->images->first()->image_name) }}" width="50" class="rounded">
                    @endif
                </td>
                <td class="text-center">£{{ number_format($product->price, 2) }}</td>
                <td class="text-center">{{ $product->category->name }}</td>
                <td class="text-center d-flex justify-content-center gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
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
