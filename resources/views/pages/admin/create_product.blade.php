@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
    <div class="container">
        <h1>Add New Product</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Product Creation Form -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div>
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="colour">Colour:</label>
                <input type="text" id="colour" name="colour">
            </div>

            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>

            <div>
                <label for="stock">Stock Quantity:</label>
                <input type="number" id="stock" name="stock" min="0" required>
            </div>

            <div class="mb-3">
                <label for="mens" class="form-label">Product Category</label>
                <select id="mens" name="mens" class="form-select">
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                </select>
            </div>

            <div>
                <label for="images">Upload Product Images:</label>
                <input type="file" id="images" name="images[]" multiple>
</div>


            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
@endsection
