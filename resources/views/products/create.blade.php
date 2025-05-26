@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>📦 Add New Product</h1>
        <p>Register a new product to start tracking its prices</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">➕ Product Information</h3>
        </div>
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Product Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required 
                       placeholder="Enter product name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control @error('category') is-invalid @enderror" 
                       id="category" name="category" value="{{ old('category') }}" 
                       placeholder="Enter product category">
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit">Unit</label>
                <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                       id="unit" name="unit" value="{{ old('unit') }}" 
                       placeholder="Enter product unit (e.g., kg, L)">
                @error('unit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Add Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection