@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>📦 Product Details</h1>
        <p>View the details of the selected product</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📦 {{ $product->name }}</h3>
            <div class="float-right">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">✏️ Edit</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <p><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</p>
            <p><strong>Unit:</strong> {{ $product->unit ?? 'N/A' }}</p>
            <p><strong>Price Entries:</strong> {{ $product->priceEntries->count() }} entries</p>
            <p><strong>Created At:</strong> {{ $product->created_at->format('d M Y') }}</p>
        </div>
    </div>
@endsection