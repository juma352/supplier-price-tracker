@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>🏪 Suppliers Management</h1>
        <p>Manage your supplier network and track their performance</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">🏪 All Suppliers</h3>
            <a href="{{ route('suppliers.create') }}" class="btn">➕ Add New Supplier</a>
        </div>
        @if($suppliers->isEmpty())
            <div class="alert alert-info">
                <p class="mb-0">No suppliers found. <a href="{{ route('suppliers.create') }}">Add your first supplier</a> to get started.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Price Entries</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>
                                    <strong>{{ $supplier->name }}</strong>
                                </td>
                                <td>{{ $supplier->contact ?? 'N/A' }}</td>
                                <td>{{ $supplier->location ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $supplier->priceEntries->count() }} entries</span>
                                </td>
                                <td>
                                    <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-sm btn-info">👁️ View</a>
                                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
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