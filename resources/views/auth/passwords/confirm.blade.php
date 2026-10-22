@extends('layouts.auth')

@section('title', 'Confirm Password | SchoolCloud SMS')

@section('body_class', 'schoolcloud-auth-body')

@section('content')
<div class="sc-login-wrapper">
    <div class="sc-auth-card">
        <div class="sc-auth-card-header">
            <a href="{{ url('/') }}" class="sc-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
            <div class="sc-card-brand">
                <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud Logo" width="32" height="32">
                <span>SchoolCloud<span class="sc-brand-accent">SMS</span></span>
            </div>
        </div>

        <div class="sc-auth-card-body">
            <span class="sc-pill-tag">Security Verification</span>
            <h2 class="sc-form-title">Confirm Password</h2>
            <p class="sc-form-subtitle">Please confirm your institutional password before continuing to this secure area.</p>

            @if($errors->any())
                <div class="sc-alert sc-alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" class="sc-login-form" novalidate>
                @csrf

                <div class="sc-field-group">
                    <div class="sc-label-row">
                        <label for="password" class="sc-field-label">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="sc-link-forgot">Forgot password?</a>
                        @endif
                    </div>
                    <div class="sc-input-wrapper password-wrapper @error('password') has-error @enderror">
                        <i class="fas fa-lock sc-input-icon"></i>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            class="sc-form-control @error('password') is-invalid @enderror" 
                            required 
                            autocomplete="current-password" 
                            placeholder="••••••••" 
                            autofocus
                        >
                        <button type="button" class="password-toggle sc-pwd-toggle" tabindex="-1" aria-label="Toggle password visibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="sc-btn-submit">
                    <span>Confirm Password</span>
                    <i class="fas fa-shield-alt"></i>
                </button>
            </form>
        </div>

        <div class="sc-auth-card-footer">
            <span class="sc-footer-copy">&copy; {{ date('Y') }} SchoolCloud SMS. All rights reserved.</span>
            <span class="sc-footer-support"><i class="fas fa-shield-alt"></i> 256-bit TLS Encrypted Session</span>
        </div>
    </div>
</div>
@endsection
