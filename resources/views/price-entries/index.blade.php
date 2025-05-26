@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>💰 Price Entries Management</h1>
        <p>Manage your price entries and track supplier pricing</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">💰 All Price Entries</h3>
            <a href="{{ route('price-entries.create') }}" class="btn">➕ Add New Price Entry</a>
        </div>
        @if($priceEntries->isEmpty())
            <div class="alert alert-info">
                <p class="mb-0">No price entries found. <a href="{{ route('price-entries.create') }}">Add your first price entry</a> to get started.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Price (KES)</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($priceEntries as $entry)
                            <tr>
                                <td>{{ $entry->product->name ?? 'N/A' }}</td>
                                <td>{{ $entry->supplier->name ?? 'N/A' }}</td>
                                <td>KSh {{ number_format($entry->price, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($entry->date)->format('d M Y') }}</td>
                                <td>{{ $entry->notes ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('price-entries.edit', $entry) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                    <form action="{{ route('price-entries.destroy', $entry) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this price entry?');">
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