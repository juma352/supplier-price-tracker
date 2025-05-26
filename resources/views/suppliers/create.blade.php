@extends('layouts.app')

@section('content')
    <div class="header">
        <h1>🏪 Add New Supplier</h1>
        <p>Register a new supplier to start tracking their prices</p>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; align-items: start;">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">➕ Supplier Information</h3>
            </div>
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Supplier Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required 
                           placeholder="Enter supplier name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact">Contact Information</label>
                    <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                           id="contact" name="contact" value="{{ old('contact') }}" 
                           placeholder="Phone number or email">
                    @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                           id="location" name="location" value="{{ old('location') }}" 
                           placeholder="City or address">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn" style="flex: 1;">Add Supplier</button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary" style="flex: 1;">Cancel</a>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">💡 Tips</h3>
            </div>
            <div style="color: #64748b; line-height: 1.6;">
                <p><strong>📝 Supplier Name:</strong> Use the official business name for easy identification.</p>
                <p><strong>📞 Contact Info:</strong> Add phone number or email for quick communication.</p>
                <p><strong>📍 Location:</strong> Include city or specific address for logistics planning.</p>
                <p><strong>🔄 Regular Updates:</strong> Keep supplier information current for accurate tracking.</p>
            </div>
        </div>
    </div>
@endsection