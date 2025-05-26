@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>📊 Price Comparison</h1>
        <p>Compare supplier prices for your products to make informed purchasing decisions</p>
    </div>

    <div class="card">
        <form method="GET" action="{{ route('price-entries.compare') }}">
            <div class="form-group">
                <label for="product_id">Select Product to Compare</label>
                <select id="product_id" name="product_id" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Select a product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ (isset($productId) && $productId == $product->id) ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if(isset($productId) && $comparisonData->isNotEmpty())
            <h3>Price Comparison for {{ $products->find($productId)->name }}</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Price (KES)</th>
                            <th>Date</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comparisonData as $supplierName => $entries)
                            @foreach($entries as $entry)
                                <tr>
                                    <td>{{ $supplierName }}</td>
                                    <td>KSh {{ number_format($entry->price, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}</td>
                                    <td>{{ $entry->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif(isset($productId))
            <p>No price entries found for the selected product.</p>
        @endif
    </div>
@endsection
