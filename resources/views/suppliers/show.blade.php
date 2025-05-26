@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>🏪 Supplier Details</h2>
                    <div>
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Name:</strong> {{ $supplier->name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Contact:</strong> {{ $supplier->contact ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Location:</strong> {{ $supplier->location ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Created:</strong> {{ $supplier->created_at->format('d M Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection