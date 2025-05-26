@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>💰 Edit Price Entry</h1>
        <p>Update the price entry information</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">✏️ Price Entry Information</h3>
        </div>
        <form method="POST" action="{{ route('price-entries.update', $priceEntry) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="product_id">Product *</label>
                <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                    <option value="">Select a product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $priceEntry->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="supplier_id">Supplier *</label>
                <select id="supplier_id" name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror" required>
                    <option value="">Select a supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $priceEntry->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price (KES) *</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                       id="price" name="price" value="{{ old('price', $priceEntry->price) }}" required step="0.01" placeholder="Enter price">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="date">Date *</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" 
                       id="date" name="date" value="{{ old('date', $priceEntry->date) }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">Notes (Optional)</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" 
                          id="notes" name="notes" rows="3">{{ old('notes', $priceEntry->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Update Price Entry</button>
                <a href="{{ route('price-entries.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection