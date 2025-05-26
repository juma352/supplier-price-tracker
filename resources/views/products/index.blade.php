@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>📦 Products Management</h1>
        <p>Manage your products and track their pricing</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📦 All Products</h3>
            <a href="{{ route('products.create') }}" class="btn">➕ Add New Product</a>
        </div>
        @if($products->isEmpty())
            <div class="alert alert-info">
                <p class="mb-0">No products found. <a href="{{ route('products.create') }}">Add your first product</a> to get started.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Price Entries</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category ?? 'N/A' }}</td>
                                <td>{{ $product->unit ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $product->priceEntries->count() }} entries</span>
                                </td>
                                <td>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">👁️ View</a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection