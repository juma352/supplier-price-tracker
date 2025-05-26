@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>💰 Price Entry Details</h1>
        <p>View the details of the selected price entry</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">💰 Price Entry for {{ $priceEntry->product->name }}</h3>
            <div class="float-right">
                <a href="{{ route('price-entries.edit', $priceEntry) }}" class="btn btn-warning">✏️ Edit</a>
                <a href="{{ route('price-entries.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <p><strong>Supplier:</strong> {{ $priceEntry->supplier->name ?? 'N/A' }}</p>
            <p><strong>Price:</strong> KSh {{ number_format($priceEntry->price, 2) }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($priceEntry->date)->format('d M Y') }}</p>
            <p><strong>Notes:</strong> {{ $priceEntry->notes ?? 'N/A' }}</p>
        </div>
    </div>
@endsection