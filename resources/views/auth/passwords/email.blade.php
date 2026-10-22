@extends('layouts.auth')

@section('title', 'Forgot Password | SchoolCloud SMS')

@section('body_class', 'schoolcloud-auth-body')

@section('content')
<div class="sc-login-wrapper">
    <div class="sc-auth-card">
        <div class="sc-auth-card-header">
            <a href="{{ route('login') }}" class="sc-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Sign In</span>
            </a>
            <div class="sc-card-brand">
                <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud Logo" width="32" height="32">
                <span>SchoolCloud<span class="sc-brand-accent">SMS</span></span>
            </div>
        </div>

        <div class="sc-auth-card-body">
            <span class="sc-pill-tag">Password Recovery</span>
            <h2 class="sc-form-title">Forgot Password?</h2>
            <p class="sc-form-subtitle">Enter your institutional email address and we'll send you a password reset link.</p>

            @if (session('status'))
                <div class="sc-alert sc-alert-success" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="sc-alert sc-alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="sc-login-form" novalidate>
                @csrf

                <div class="sc-field-group">
                    <label for="email" class="sc-field-label">Institutional Email</label>
                    <div class="sc-input-wrapper @error('email') has-error @enderror">
                        <i class="fas fa-envelope sc-input-icon"></i>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            class="sc-form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}" 
                            required 
                            autocomplete="email" 
                            autofocus 
                            placeholder="admin@school.edu.ng"
                        >
                    </div>
                    @error('email')
                        <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="sc-btn-submit">
                    <span>Send Password Reset Link</span>
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>

            <div class="sc-auth-card-alt">
                <span>Remember your credentials?</span>
                <a href="{{ route('login') }}" class="sc-link-forgot">Sign in here</a>
            </div>
        </div>

        <div class="sc-auth-card-footer">
            <span class="sc-footer-copy">&copy; {{ date('Y') }} SchoolCloud SMS. All rights reserved.</span>
            <span class="sc-footer-support"><i class="fas fa-shield-alt"></i> Protected by 256-bit TLS encryption</span>
        </div>
    </div>
</div>
@endsection
