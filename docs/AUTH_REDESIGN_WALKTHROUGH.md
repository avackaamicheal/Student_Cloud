# SchoolCloud SMS - Authentication Redesign Walkthrough & Architecture Reference

This document records the design system, template architecture, interactive features, and verification suite for the **SchoolCloud SMS** authentication and onboarding overhaul. It serves as a persistent reference within the repository.

---

## 1. Project Background & Aesthetic Directives

- **Brand Transition**: Replaced all remaining legacy "Axia SMS" references, outdated 2018 pastel SVG blob illustrations, and default AdminLTE boxes with official **SchoolCloud SMS** branding (`dist/img/axia-logo.svg`, deep navy `#0f172a`, indigo `#3730a3`, and violet accent `#4f46e5`).
- **Typography**: Integrated Google Fonts / Bunny **Plus Jakarta Sans** (weights 400, 500, 600, 700, 800) across all authentication layouts.
- **Domain Authenticity ("Not AI")**: Grounded showcase content, prompts, and indicators in real Nigerian primary and secondary school workflows:
  - Continuous Assessment (CA) weighting and termly report cards.
  - Automated Naira (`₦`) bursary receipts and family ledger reconciliation.
  - Multi-portal access for School Admins, Teachers, Bursars, Parents, and Students.
  - Tenant data isolation per school institution.
- **UX & Accessibility**:
  - Embedded input icons with focus-within ring transitions.
  - Secure password visibility toggles (`fas fa-eye` / `fas fa-eye-slash`).
  - Seamless "← Back to Home" and "← Back to Sign In" breadcrumb links.
  - Multi-step validation, read-only field syncing, and smooth step transitions.

---

## 2. Implemented Architecture & Component Manifest

```
sms/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── auth.blade.php                # Master authentication layout (title fallback, Plus Jakarta Sans, shared scripts)
│   │   └── auth/
│   │       ├── login.blade.php               # Redesigned dual-pane login portal with domain showcase & role badges
│   │       ├── register-school.blade.php     # 3-step institutional onboarding wizard with milestone progress bar
│   │       └── passwords/
│   │           ├── reset.blade.php           # Set new password view in elevated centered card
│   │           ├── email.blade.php           # Forgot password link request view in elevated centered card
│   │           └── confirm.blade.php         # Password confirmation view in elevated centered card
│   └── css/
│       └── auth.css                          # Handcrafted CSS design tokens, wizard steps, and responsive breakpoints
├── public/
│   └── build/
│       └── assets/
│           └── auth-*.css                    # Vite compiled production stylesheet
├── tests/
│   └── Feature/
│       ├── LoginTest.php                     # 5 feature tests for login rendering, validation, and role redirects
│       ├── SchoolRegistrationTest.php        # 4 feature tests for registration wizard, database insertion, and validation
│       └── PasswordResetTest.php             # 4 feature tests for reset request, token validation, and password update
└── docs/
    ├── LANDING_PAGE_WALKTHROUGH.md           # Landing page walkthrough
    └── AUTH_REDESIGN_WALKTHROUGH.md          # This persistent authentication reference document
```

---

## 3. Redesigned Modules & Implementation Details

### A. Master Layout (`resources/views/layouts/auth.blade.php`)
- Default title fallback upgraded to `'SchoolCloud SMS'`.
- Preconnect and stylesheet link added for `Plus Jakarta Sans`:
  ```html
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  ```
- Retained full backward compatibility with AdminLTE overrides, FontAwesome icons, and the jQuery password toggle handler.

---

### B. Portal Login View (`resources/views/auth/login.blade.php`)
- **Left Showcase Sidebar (`.sc-showcase-pane`)**:
  - SchoolCloud SMS logo badge and brand lockup.
  - Headline: *"Run your entire school with clarity & control."*
  - Key domain feature highlights:
    - 📑 **Assessment & Report Cards**: CA test weighting (Test 1, Test 2, Exam) with instant terminal PDF reports.
    - 💳 **Naira (₦) Bursary & Invoicing**: Verifiable receipt references, payment reconciliation, and family ledger tracking.
    - 👥 **Dedicated Role Portals**: Fine-grained spaces for School Admins, Teachers, Bursars, Parents, and Students.
  - Security badge: 256-bit TLS encrypted session & tenant data isolation.
- **Right Interactive Form (`.sc-form-pane`)**:
  - Header: `"← Back to Home"` link leading back to `landing`.
  - Form intro: `"PORTAL AUTHENTICATION"` pill badge, `"Welcome Back"`, and instructions.
  - Embedded input icons (`fas fa-envelope`, `fas fa-lock`) with focus rings.
  - Password visibility toggle (`.password-toggle`).
  - Styled `"Keep me signed in"` remember checkbox.
  - Gradient high-contrast button: `"Sign In to Portal"`.
  - Roles Indicator: Single Sign-On badges for Admin, Teacher, Bursar, Parent, and Student.
  - Secondary Onboarding Card: *"New institution looking to onboard? Register School"*.

---

### C. Multi-Step School Onboarding Wizard (`resources/views/auth/register-school.blade.php`)
- **Showcase & Milestone Sidebar (`.sc-wizard-sidebar`)**:
  - Circular milestone badges with step indicators:
    - **Step 1**: School Profile (Name, Email, Phone, Address)
    - **Step 2**: Administrator (Principal Name, Admin Name, Synced Email)
    - **Step 3**: Security & Submit (Password, Confirm Password)
  - States: Active (indigo badge with glowing ring), Done (emerald badge with `✓` checkmark), Future (translucent badge).
  - Highlights: Tenant isolation, automatic academic term initialization, Naira fee invoicing.
- **Interactive Form Pane (`.sc-wizard-content-pane`)**:
  - Header bar: `"← Back to Home"` and `"Already registered? Sign In"`.
  - Step 1: Institutional contact with embedded icons.
  - Step 2: Administrator lead details; syncs `school_email` into read-only login email.
  - Step 3: Password creation with minimum 8 character hint and toggle buttons.
  - Thank You / Completion State (`session('registered')`):
    - Emerald verification checkmark icon.
    - Title: *"Registration Successful!"*.
    - High-contrast action button pointing directly to `{{ route('subscription.index') }}`.
- **Interactive Client-Side Script**:
  - Smooth fade transitions between fieldsets.
  - Required field validation before advancing to the next step.
  - Automatic error highlighting and smooth scroll-to-error on submission.

---

### D. Password Recovery & Reset Views (`resources/views/auth/passwords/`)
- **Reset Password (`reset.blade.php`)**:
  - Centered elevated card (`.sc-auth-card`) with SchoolCloud SMS brand badge.
  - Navigation: `"← Back to Sign In"`.
  - Pill tag: `"PASSWORD RECOVERY"`.
  - Form fields: Hidden token, email input, new password with toggle, confirm password with toggle.
  - Gradient submit button: `"Reset Password & Sign In"`.
- **Forgot Password Request (`email.blade.php`)**:
  - Centered card matching design system.
  - Displays session status flashes (`session('status')`) in a clean alert.
  - Institutional email input and `"Send Password Reset Link"` button.
- **Confirm Password (`confirm.blade.php`)**:
  - Centered card for secure re-authentication with password toggle and submit action.

---

## 4. CSS Design Tokens & Breakpoints (`resources/css/auth.css`)

```css
:root {
    --sc-navy: #0f172a;
    --sc-navy-dark: #0a0f1d;
    --sc-indigo: #3730a3;
    --sc-indigo-hover: #312e81;
    --sc-indigo-light: #eef2ff;
    --sc-accent: #4f46e5;
    --sc-accent-bright: #6366f1;
    --sc-slate: #475569;
    --sc-muted: #64748b;
    --sc-subtle: #94a3b8;
    --sc-border: #e2e8f0;
    --sc-border-focus: #cbd5e1;
    --sc-bg: #f8fafc;
    --sc-white: #ffffff;
    --sc-emerald: #059669;
    --sc-emerald-light: #ecfdf5;
    --sc-danger: #e11d48;
    --sc-danger-light: #fff1f2;
}
```

### Breakpoints
- **Desktop (≥ 992px)**: Dual-pane side-by-side card (`flex: 0 0 440px` sidebar, `flex: 1` form).
- **Tablet (≤ 991px)**: Stacked column layout (`max-width: 580px`), milestone steps collapse to horizontal layout, compact sidebar.
- **Mobile (≤ 576px)**: Form fields expand to 100% width, buttons stack full-width, touch targets sized ≥ 48px.

---

## 5. Verification Suite & Results

### Automated Tests
Run all authentication and landing page tests via PHPUnit / Pest:

```bash
# 1. School Registration Tests
php artisan test --filter=SchoolRegistrationTest
# PASS Tests\Feature\SchoolRegistrationTest
# ✓ school registration page loads with branding and milestones          0.62s  
# ✓ school can be registered successfully                                0.09s  
# ✓ registration fails validation when required fields missing           0.04s  
# ✓ registration fails when passwords do not match                       0.03s  
# Tests: 4 passed (40 assertions)

# 2. Password Reset & Recovery Tests
php artisan test --filter=PasswordResetTest
# PASS Tests\Feature\PasswordResetTest
# ✓ forgot password page loads with schoolcloud branding                 0.98s  
# ✓ reset password page loads with token and schoolcloud branding        0.08s  
# ✓ user can request password reset link                                 1.80s  
# ✓ user can reset password with valid token                             0.16s  
# Tests: 4 passed (20 assertions)

# 3. Portal Login Tests
php artisan test --filter=LoginTest
# PASS Tests\Feature\LoginTest
# ✓ login page renders with schoolcloud branding and form controls       1.10s  
# ✓ user cannot login with invalid credentials                           0.28s  
# ✓ superadmin can login and redirects to dashboard                      0.06s  
# ✓ teacher can login and redirects to school dashboard                  0.06s  
# ✓ authenticated user visiting login page is redirected                 0.06s  
# Tests: 5 passed (36 assertions)

# 4. Landing Page Tests
php artisan test --filter=LandingPageTest
# PASS Tests\Feature\LandingPageTest
# ✓ landing page loads successfully for guest                            0.97s  
# ✓ landing page displays active subscription plans                      0.07s  
# ✓ landing page shows dashboard link for authenticated admin            0.11s  
# Tests: 3 passed (28 assertions)
```

**Total Across Redesigned Surface**: 16 passing tests, 124 assertions, 0 failures.

---

## 6. Route & Endpoint Directory

| Route Name | URI | Method | View File | Purpose |
|---|---|---|---|---|
| `login` | `/login` | `GET` / `POST` | `auth.login` | Institutional portal sign in |
| `school.register` | `/register/school` | `GET` | `auth.register-school` | 3-step school onboarding wizard |
| `school.register.store` | `/register/school` | `POST` | — | Validates & creates school + admin |
| `password.request` | `/password/reset` | `GET` | `auth.passwords.email` | Password reset link request |
| `password.email` | `/password/email` | `POST` | — | Dispatches reset link email |
| `password.reset` | `/password/reset/{token}` | `GET` | `auth.passwords.reset` | Set new password form |
| `password.update` | `/password/reset` | `POST` | — | Updates password & authenticates |
| `password.confirm` | `/password/confirm` | `GET` / `POST` | `auth.passwords.confirm` | Sudo mode password confirmation |
