@extends('layouts.auth')

@section('title', 'Sign In | SchoolCloud SMS')

@section('body_class', 'schoolcloud-auth-body')

@section('content')
<div class="sc-login-wrapper">
    <div class="sc-login-container">
        <!-- Brand Showcase Sidebar (Desktop & Tablet) -->
        <aside class="sc-showcase-pane">
            <div class="sc-showcase-pattern" aria-hidden="true"></div>

            <div class="sc-showcase-header">
                <a href="{{ route('landing') }}" class="sc-brand-lockup" title="Return to SchoolCloud SMS Homepage">
                    <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud SMS Logo" class="sc-brand-logo" width="40" height="40">
                    <div class="sc-brand-text">
                        <span class="sc-brand-name">SchoolCloud<span class="sc-brand-accent">SMS</span></span>
                        <span class="sc-brand-tagline">Unified School Management Portal</span>
                    </div>
                </a>
            </div>

            <div class="sc-showcase-body">
                <span class="sc-badge-lead">Authentic Academic OS</span>
                <h1 class="sc-showcase-title">Run your entire school with clarity & control.</h1>
                <p class="sc-showcase-desc">
                    A purpose-built management system powering Nigerian primary and secondary schools with precision, accountability, and cloud speed.
                </p>

                <div class="sc-features-list">
                    <div class="sc-feature-item">
                        <div class="sc-feature-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="sc-feature-content">
                            <h4>Assessment & Report Cards</h4>
                            <p>Continuous Assessment (CA) weighting with instantaneous terminal PDF reports & class ranks.</p>
                        </div>
                    </div>

                    <div class="sc-feature-item">
                        <div class="sc-feature-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="sc-feature-content">
                            <h4>Naira (₦) Bursary & Invoicing</h4>
                            <p>Verifiable receipt references, payment reconciliation, and multi-child family ledger tracking.</p>
                        </div>
                    </div>

                    <div class="sc-feature-item">
                        <div class="sc-feature-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="sc-feature-content">
                            <h4>Dedicated Role Portals</h4>
                            <p>Fine-grained access for School Admins, Teachers, Bursars, Parents, and Students.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sc-showcase-footer">
                <div class="sc-security-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>256-bit TLS Encrypted • Tenant Data Isolation</span>
                </div>
            </div>
        </aside>

        <!-- Interactive Form Pane -->
        <main class="sc-form-pane">
            <div class="sc-form-header-bar">
                <a href="{{ route('landing') }}" class="sc-back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>

                <!-- Mobile brand display when showcase is collapsed -->
                <div class="sc-mobile-brand">
                    <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud Logo" width="28" height="28">
                    <span>SchoolCloud<span class="sc-brand-accent">SMS</span></span>
                </div>
            </div>

            <div class="sc-form-content">
                <div class="sc-form-intro">
                    <span class="sc-pill-tag">Portal Authentication</span>
                    <h2 class="sc-form-title">Welcome Back</h2>
                    <p class="sc-form-subtitle">Enter your institutional credentials to access your dashboard.</p>
                </div>

                @if(session('status'))
                    <div class="sc-alert sc-alert-success" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if($errors->any() && !old('email'))
                    <div class="sc-alert sc-alert-danger" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="sc-login-form" novalidate>
                    @csrf

                    <div class="sc-field-group">
                        <label for="email" class="sc-field-label">Email Address</label>
                        <div class="sc-input-wrapper @error('email') has-error @enderror">
                            <i class="fas fa-envelope sc-input-icon"></i>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                class="sc-form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email') }}" 
                                placeholder="name@school.edu.ng" 
                                required 
                                autofocus 
                                autocomplete="email"
                            >
                        </div>
                        @error('email')
                            <span class="sc-error-message" role="alert">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="sc-field-group">
                        <div class="sc-label-row">
                            <label for="password" class="sc-field-label">Password</label>
                            @if(Route::has('password.request'))
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
                                placeholder="••••••••" 
                                required 
                                autocomplete="current-password"
                            >
                            <button type="button" class="password-toggle sc-pwd-toggle" tabindex="-1" aria-label="Toggle password visibility">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="sc-error-message" role="alert">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="sc-field-group sc-options-row">
                        <label class="sc-checkbox-label">
                            <input type="checkbox" name="remember" id="remember" class="sc-checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <span class="sc-checkbox-text">Keep me signed in</span>
                        </label>
                    </div>

                    <button type="submit" class="sc-btn-submit">
                        <span>Sign In to Portal</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <!-- Portal Roles Indicator -->
                <div class="sc-roles-indicator">
                    <span class="sc-roles-title">Single Sign-On access for:</span>
                    <div class="sc-roles-pills">
                        <span class="sc-role-pill"><i class="fas fa-user-shield"></i> School Admin</span>
                        <span class="sc-role-pill"><i class="fas fa-chalkboard-teacher"></i> Teacher</span>
                        <span class="sc-role-pill"><i class="fas fa-calculator"></i> Bursar</span>
                        <span class="sc-role-pill"><i class="fas fa-user-friends"></i> Parent</span>
                        <span class="sc-role-pill"><i class="fas fa-user-graduate"></i> Student</span>
                    </div>
                </div>

                <!-- Secondary Onboarding Action -->
                <div class="sc-register-card">
                    <div class="sc-register-icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="sc-register-text">
                        <span class="sc-register-title">New institution looking to onboard?</span>
                        <span class="sc-register-desc">Create your school's workspace in minutes.</span>
                    </div>
                    <a href="{{ route('school.register') }}" class="sc-register-btn">
                        <span>Register School</span>
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>

            <div class="sc-form-footer">
                <span class="sc-footer-copy">&copy; {{ date('Y') }} SchoolCloud SMS. All rights reserved.</span>
                <span class="sc-footer-support">Need assistance? Contact your school portal administrator.</span>
            </div>
        </main>
    </div>
</div>
@endsection
