@extends('layouts.auth')

@section('title', 'Register Your School | SchoolCloud SMS')

@section('body_class', 'schoolcloud-auth-body')

@section('content')
<div class="sc-login-wrapper sc-wizard-page">
    <div class="sc-login-container sc-wizard-container">

        <!-- Wizard Milestone Sidebar -->
        <aside class="sc-showcase-pane sc-wizard-sidebar">
            <div class="sc-showcase-pattern" aria-hidden="true"></div>

            <div class="sc-showcase-header">
                <a href="{{ route('landing') }}" class="sc-brand-lockup" title="Return to SchoolCloud SMS Homepage">
                    <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud SMS Logo" class="sc-brand-logo" width="40" height="40">
                    <div class="sc-brand-text">
                        <span class="sc-brand-name">SchoolCloud<span class="sc-brand-accent">SMS</span></span>
                        <span class="sc-brand-tagline">Institutional Onboarding</span>
                    </div>
                </a>
            </div>

            <div class="sc-showcase-body">
                <span class="sc-badge-lead">School Onboarding</span>
                <h1 class="sc-showcase-title">Setup your school portal in 3 simple steps.</h1>
                <p class="sc-showcase-desc">
                    Join primary and secondary schools across Nigeria managing admissions, grading, fee collections, and parent communication on one unified platform.
                </p>

                <!-- Milestone Steps List -->
                <div class="sc-wizard-steps" id="step-indicator">
                    <div class="sc-step-item active" data-step="1">
                        <div class="sc-step-badge">1</div>
                        <div class="sc-step-meta">
                            <span class="sc-step-index">STEP 1</span>
                            <span class="sc-step-name">School Profile</span>
                        </div>
                    </div>

                    <div class="sc-step-item" data-step="2">
                        <div class="sc-step-badge">2</div>
                        <div class="sc-step-meta">
                            <span class="sc-step-index">STEP 2</span>
                            <span class="sc-step-name">Administrator</span>
                        </div>
                    </div>

                    <div class="sc-step-item" data-step="3">
                        <div class="sc-step-badge">3</div>
                        <div class="sc-step-meta">
                            <span class="sc-step-index">STEP 3</span>
                            <span class="sc-step-name">Security & Submit</span>
                        </div>
                    </div>
                </div>

                <div class="sc-wizard-highlights">
                    <div class="sc-highlight-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Tenant data isolation per institution</span>
                    </div>
                    <div class="sc-highlight-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>Automated academic session initialization</span>
                    </div>
                    <div class="sc-highlight-item">
                        <i class="fas fa-coins"></i>
                        <span>Naira (₦) Bursary & CA report card engine</span>
                    </div>
                </div>
            </div>

            <div class="sc-showcase-footer">
                <div class="sc-security-badge">
                    <i class="fas fa-check-circle"></i>
                    <span>Official Nigerian School Software • 256-bit TLS</span>
                </div>
            </div>
        </aside>

        <!-- Wizard Interactive Content Pane -->
        <main class="sc-form-pane sc-wizard-content-pane">
            <div class="sc-form-header-bar">
                <a href="{{ route('landing') }}" class="sc-back-link">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>

                <div class="sc-header-alt-action">
                    <span class="sc-header-alt-text">Already registered?</span>
                    <a href="{{ route('login') }}" class="sc-header-alt-link">Sign In</a>
                </div>
            </div>

            <div class="sc-form-content sc-wizard-form-content">
                @if(session('registered'))
                    <!-- Thank You / Completion State -->
                    <div class="sc-completion-card">
                        <div class="sc-completion-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="sc-pill-tag">Setup Complete</span>
                        <h2 class="sc-completion-title">Registration Successful!</h2>
                        <p class="sc-completion-desc">
                            Your school workspace has been provisioned. Set up your institutional subscription plan to activate your portal and start onboarding staff, students, and parents.
                        </p>
                        <div class="sc-completion-actions">
                            <a href="{{ route('subscription.index') }}" class="sc-btn-submit sc-btn-complete">
                                <span>Continue to Subscription</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Error Summary -->
                    @if(session('error'))
                        <div class="sc-alert sc-alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="sc-alert sc-alert-danger sc-alert-summary" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="sc-alert-text">
                                <span class="sc-alert-lead">Please correct the following errors:</span>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Registration Wizard Form -->
                    <form action="{{ route('school.register.store') }}" method="POST" class="sc-wizard-form registration-form" novalidate>
                        @csrf

                        <!-- Step 1: School Information -->
                        <fieldset class="sc-wizard-fieldset" data-step="1">
                            <div class="sc-form-intro">
                                <span class="sc-pill-tag">Step 1 of 3</span>
                                <h2 class="sc-form-title">School Details</h2>
                                <p class="sc-form-subtitle">Enter your official institutional contact and location information.</p>
                            </div>

                            <div class="sc-field-group">
                                <label for="school_name" class="sc-field-label">School Name</label>
                                <div class="sc-input-wrapper @error('school_name') has-error @enderror">
                                    <i class="fas fa-school sc-input-icon"></i>
                                    <input 
                                        id="school_name" 
                                        type="text" 
                                        name="school_name" 
                                        class="sc-form-control @error('school_name') is-invalid @enderror" 
                                        value="{{ old('school_name') }}" 
                                        placeholder="e.g. Saint Murumba College" 
                                        required 
                                        autofocus
                                    >
                                </div>
                                @error('school_name')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-field-group">
                                <label for="school_email" class="sc-field-label">Official School Email</label>
                                <div class="sc-input-wrapper @error('school_email') has-error @enderror">
                                    <i class="fas fa-envelope sc-input-icon"></i>
                                    <input 
                                        id="school_email" 
                                        type="email" 
                                        name="school_email" 
                                        class="sc-form-control @error('school_email') is-invalid @enderror" 
                                        value="{{ old('school_email') }}" 
                                        placeholder="info@school.edu.ng" 
                                        required
                                    >
                                </div>
                                @error('school_email')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-field-group">
                                <label for="school_phone" class="sc-field-label">Phone Number</label>
                                <div class="sc-input-wrapper @error('school_phone') has-error @enderror">
                                    <i class="fas fa-phone-alt sc-input-icon"></i>
                                    <input 
                                        id="school_phone" 
                                        type="text" 
                                        name="school_phone" 
                                        class="sc-form-control @error('school_phone') is-invalid @enderror" 
                                        value="{{ old('school_phone') }}" 
                                        placeholder="e.g. 08012345678" 
                                        required
                                    >
                                </div>
                                @error('school_phone')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-field-group">
                                <label for="school_address" class="sc-field-label">School Address</label>
                                <div class="sc-input-wrapper @error('school_address') has-error @enderror">
                                    <i class="fas fa-map-marker-alt sc-input-icon sc-textarea-icon"></i>
                                    <textarea 
                                        id="school_address" 
                                        name="school_address" 
                                        class="sc-form-control sc-textarea @error('school_address') is-invalid @enderror" 
                                        rows="2" 
                                        placeholder="Full physical school address" 
                                        required>{{ old('school_address') }}</textarea>
                                </div>
                                @error('school_address')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-wizard-actions">
                                <div></div>
                                <button type="button" class="sc-btn-submit sc-btn-next btn-next-step">
                                    <span>Next: Administrator Profile</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </fieldset>

                        <!-- Step 2: Admin Profile -->
                        <fieldset class="sc-wizard-fieldset" data-step="2">
                            <div class="sc-form-intro">
                                <span class="sc-pill-tag">Step 2 of 3</span>
                                <h2 class="sc-form-title">Administrator Profile</h2>
                                <p class="sc-form-subtitle">Set up the primary administrative authority and login profile.</p>
                            </div>

                            <div class="sc-field-group">
                                <label for="principal_name" class="sc-field-label">Principal / Head of School's Name</label>
                                <div class="sc-input-wrapper @error('principal_name') has-error @enderror">
                                    <i class="fas fa-user-tie sc-input-icon"></i>
                                    <input 
                                        id="principal_name" 
                                        type="text" 
                                        name="principal_name" 
                                        class="sc-form-control @error('principal_name') is-invalid @enderror" 
                                        value="{{ old('principal_name') }}" 
                                        placeholder="e.g. Dr. John Adebayo" 
                                        required
                                    >
                                </div>
                                @error('principal_name')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-field-group">
                                <label for="admin_name" class="sc-field-label">Administrator Full Name</label>
                                <div class="sc-input-wrapper @error('admin_name') has-error @enderror">
                                    <i class="fas fa-user-shield sc-input-icon"></i>
                                    <input 
                                        id="admin_name" 
                                        type="text" 
                                        name="admin_name" 
                                        class="sc-form-control @error('admin_name') is-invalid @enderror" 
                                        value="{{ old('admin_name') }}" 
                                        placeholder="e.g. Jane Smith" 
                                        required
                                    >
                                </div>
                                @error('admin_name')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-field-group">
                                <label for="school_email_readonly" class="sc-field-label">Login Email Address</label>
                                <div class="sc-input-wrapper">
                                    <i class="fas fa-envelope-open-text sc-input-icon"></i>
                                    <input 
                                        id="school_email_readonly" 
                                        type="email" 
                                        name="school_email_readonly" 
                                        class="sc-form-control sc-readonly" 
                                        value="{{ old('school_email') }}" 
                                        placeholder="info@school.edu.ng" 
                                        readonly
                                    >
                                </div>
                                <span class="sc-field-hint">
                                    <i class="fas fa-lock"></i> Synchronized from Step 1. This will be your primary portal login ID.
                                </span>
                            </div>

                            <div class="sc-wizard-actions">
                                <button type="button" class="sc-btn-back btn-previous-step">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Go Back</span>
                                </button>
                                <button type="button" class="sc-btn-submit sc-btn-next btn-next-step">
                                    <span>Next: Account Security</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </fieldset>

                        <!-- Step 3: Security & Finish -->
                        <fieldset class="sc-wizard-fieldset" data-step="3">
                            <div class="sc-form-intro">
                                <span class="sc-pill-tag">Step 3 of 3</span>
                                <h2 class="sc-form-title">Account Security</h2>
                                <p class="sc-form-subtitle">Choose a secure password for your administrator account.</p>
                            </div>

                            <div class="sc-field-group">
                                <label for="admin_password" class="sc-field-label">Administrator Password</label>
                                <div class="sc-input-wrapper password-wrapper @error('admin_password') has-error @enderror">
                                    <i class="fas fa-lock sc-input-icon"></i>
                                    <input 
                                        id="admin_password" 
                                        type="password" 
                                        name="admin_password" 
                                        class="sc-form-control @error('admin_password') is-invalid @enderror" 
                                        placeholder="••••••••" 
                                        required 
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="password-toggle sc-pwd-toggle" tabindex="-1" aria-label="Toggle password visibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('admin_password')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                                <span class="sc-field-hint">Must contain at least 8 characters.</span>
                            </div>

                            <div class="sc-field-group">
                                <label for="admin_password_confirmation" class="sc-field-label">Confirm Password</label>
                                <div class="sc-input-wrapper password-wrapper @error('admin_password_confirmation') has-error @enderror">
                                    <i class="fas fa-lock sc-input-icon"></i>
                                    <input 
                                        id="admin_password_confirmation" 
                                        type="password" 
                                        name="admin_password_confirmation" 
                                        class="sc-form-control @error('admin_password_confirmation') is-invalid @enderror" 
                                        placeholder="••••••••" 
                                        required 
                                        autocomplete="new-password"
                                    >
                                    <button type="button" class="password-toggle sc-pwd-toggle" tabindex="-1" aria-label="Toggle password visibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('admin_password_confirmation')
                                    <span class="sc-error-message"><i class="fas fa-info-circle"></i> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sc-wizard-actions">
                                <button type="button" class="sc-btn-back btn-previous-step">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Go Back</span>
                                </button>
                                <button type="submit" class="sc-btn-submit sc-btn-confirm">
                                    <i class="fas fa-check"></i>
                                    <span>Complete Registration</span>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                @endif
            </div>

            <div class="sc-form-footer">
                <span class="sc-footer-copy">&copy; {{ date('Y') }} SchoolCloud SMS. All rights reserved.</span>
                <span class="sc-footer-support">Need assistance? Contact support@schoolcloud.ng</span>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function($) {
        var $form = $('.registration-form');
        var $fieldsets = $form.find('fieldset');
        var $steps = $('#step-indicator .sc-step-item');

        $fieldsets.hide().first().show();

        $form.find('input, textarea').on('focus input', function() {
            $(this).removeClass('is-invalid');
            $(this).closest('.sc-input-wrapper').removeClass('has-error');
        });

        function goToStep(index) {
            $steps.each(function(i) {
                var stepNum = i + 1;
                $(this).removeClass('active done');
                if (stepNum === index) {
                    $(this).addClass('active');
                } else if (stepNum < index) {
                    $(this).addClass('done');
                }
            });
        }

        function validateFieldset($fieldset) {
            var valid = true;
            $fieldset.find('.sc-form-control[required]').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                    $(this).closest('.sc-input-wrapper').addClass('has-error');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).closest('.sc-input-wrapper').removeClass('has-error');
                }
            });
            return valid;
        }

        $('.btn-next-step').on('click', function() {
            var $current = $(this).closest('fieldset');
            if (!validateFieldset($current)) return;

            if ($current.is(':first-child')) {
                $('[name="school_email_readonly"]').val($('[name="school_email"]').val());
            }

            var $next = $current.next('fieldset');
            if ($next.length) {
                $current.fadeOut(200, function() {
                    $next.fadeIn(200);
                    goToStep($next.index() + 1);
                });
            }
        });

        $('.btn-previous-step').on('click', function() {
            var $current = $(this).closest('fieldset');
            var $prev = $current.prev('fieldset');
            if ($prev.length) {
                $current.fadeOut(200, function() {
                    $prev.fadeIn(200);
                    goToStep($prev.index() + 1);
                });
            }
        });

        $form.on('submit', function(e) {
            var allValid = true;
            $fieldsets.find('.sc-form-control[required]').each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                    $(this).closest('.sc-input-wrapper').addClass('has-error');
                    allValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).closest('.sc-input-wrapper').removeClass('has-error');
                }
            });

            if (!allValid) {
                e.preventDefault();
                var $firstError = $fieldsets.find('.is-invalid').first().closest('fieldset');
                var targetIndex = $firstError.length ? $fieldsets.index($firstError) + 1 : 1;

                $fieldsets.hide();
                $firstError.length ? $firstError.show() : $fieldsets.first().show();
                goToStep(targetIndex);

                $('html, body').animate({
                    scrollTop: $('.sc-wizard-content-pane').offset().top - 20
                }, 200);

                $fieldsets.find('.is-invalid').first().focus();
            }
        });
    });
</script>
@endpush
