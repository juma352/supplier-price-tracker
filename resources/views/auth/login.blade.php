@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 400px; margin-top: 80px;">
    <div class="card">
        <h2 class="card-title" style="text-align: center; margin-bottom: 20px;">Login</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <label for="password">Password</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mt-4">
                <div class="form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember" />
                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-primary ms-3">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
