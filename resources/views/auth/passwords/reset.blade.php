@extends('layouts.auth')

@section('title', 'Set New Password | SchoolCloud SMS')

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
            <h2 class="sc-form-title">Set New Password</h2>
            <p class="sc-form-subtitle">Choose a new secure password for your institutional account.</p>

            @if($errors->any())
                <div class="sc-alert sc-alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="sc-login-form" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="sc-field-group">
                    <label for="email" class="sc-field-label">Email Address</label>
                    <div class="sc-input-wrapper @error('email') has-error @enderror">
                        <i class="fas fa-envelope sc-input-icon"></i>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            class="sc-form-control @error('email') is-invalid @enderror" 
                            value="{{ $email ?? old('email') }}" 
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

                <div class="sc-field-group">
                    <label for="password" class="sc-field-label">New Password</label>
                    <div class="sc-input-wrapper password-wrapper @error('password') has-error @enderror">
                        <i class="fas fa-lock sc-input-icon"></i>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            class="sc-form-control @error('password') is-invalid @enderror" 
                            required 
                            autocomplete="new-password" 
                            placeholder="••••••••"
                        >
                        <button type="button" class="password-toggle sc-pwd-toggle" tabindex="-1" aria-label="Toggle password visibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="sc-field-group">
                    <label for="password-confirm" class="sc-field-label">Confirm New Password</label>
                    <div class="sc-input-wrapper password-wrapper">
                        <i class="fas fa-lock sc-input-icon"></i>
                        <input 
                            id="password-confirm" 
                            type="password" 
                            name="password_confirmation" 
                            class="sc-form-control" 
                            required 
                            autocomplete="new-password" 
                            placeholder="••••••••"
                        >
                        <button type="button" class="password-toggle sc-pwd-toggle" tabindex="-1" aria-label="Toggle password visibility">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="sc-btn-submit">
                    <span>Reset Password & Sign In</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>

        <div class="sc-auth-card-footer">
            <span class="sc-footer-copy">&copy; {{ date('Y') }} SchoolCloud SMS. All rights reserved.</span>
            <span class="sc-footer-support"><i class="fas fa-shield-alt"></i> Protected by 256-bit TLS encryption</span>
        </div>
    </div>
</div>
@endsection
