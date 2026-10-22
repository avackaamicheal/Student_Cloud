<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SchoolCloud | All-in-One School Management System</title>
    <meta name="description" content="SchoolCloud SMS is the complete school management system for primary and secondary schools. Streamline admissions, grading, terminal report cards, fee collection, and parent communication.">
    <meta name="keywords" content="school management system, Nigerian school software, report card generator, school fees bursary, student attendance, school portal">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Custom Landing Styles -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- =====================================================================
         NAVBAR
         ===================================================================== -->
    <nav class="navbar navbar-expand-lg navbar-landing sticky-top" id="topNav">
        <div class="container">
            <a class="brand-badge navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud SMS Logo" width="34" height="34">
                <span>SchoolCloud<span style="color: var(--brand-accent);">SMS</span></span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#landingNavbar" aria-controls="landingNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="landingNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#roles">Portals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#report-cards">Report Cards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#bursary">Bursary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#faq">FAQ</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-brand-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border">
                                <li>
                                    <a class="dropdown-item py-2" href="{{ auth()->user()->dashboardUrl() }}">
                                        <i class="fas fa-tachometer-alt me-2 text-primary"></i> Go to Dashboard
                                    </a>
                                </li>
                                <li><hr class="dropdown-menu-divider my-1"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> Sign Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ auth()->user()->dashboardUrl() }}" class="btn btn-brand-primary">
                            Dashboard <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="link-dark text-decoration-underline link-offset-3 fw-semibold me-3 px-1">
                            Sign In
                        </a>
                        <a href="{{ route('school.register') }}" class="btn btn-brand-primary">
                            Register School
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <!-- =====================================================================
         HERO SECTION
         ===================================================================== -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="eyebrow-pill">
                        <i class="fas fa-graduation-cap"></i> Built for Primary &amp; Secondary Schools
                    </div>
                    <h1 class="hero-title">
                        Run your entire school with clarity &amp; control.
                    </h1>
                    <p class="hero-subtitle">
                        Replace messy spreadsheets and end-of-term chaos. S manages student admissions, Continuous Assessment grading, automated terminal report cards, and bursary fee collections in one dependable platform.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('school.register') }}" class="btn btn-brand-primary btn-lg px-4 py-3">
                            Register Your School
                        </a>
                        <a href="#report-cards" class="btn btn-brand-secondary btn-lg px-4 py-3">
                            See Report Card Engine
                        </a>
                    </div>

                    <div class="hero-trust-list">
                        <div class="trust-item">
                            <i class="fas fa-check-circle"></i> Termly Academic Cycles
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-check-circle"></i> Batch PDF Report Cards
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-check-circle"></i> Naira (₦) Fee Invoicing
                        </div>
                        <div class="trust-item">
                            <i class="fas fa-check-circle"></i> 100% Cloud Accessible
                        </div>
                    </div>
                </div>

                <!-- Live Tactile UI Preview Window -->
                <div class="col-lg-6">
                    <div class="browser-frame">
                        <div class="browser-header">
                            <div class="browser-dots">
                                <span class="browser-dot dot-red"></span>
                                <span class="browser-dot dot-yellow"></span>
                                <span class="browser-dot dot-green"></span>
                            </div>
                            <div class="browser-address">
                                <i class="fas fa-lock text-success"></i> SchoolCloud.app/school/crown-academy/dashboard
                            </div>
                        </div>

                        <div class="mock-dashboard-content">
                            <!-- Quick Metric Cards -->
                            <div class="row g-2 mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="mock-stat-card">
                                        <div class="mock-stat-label">Students</div>
                                        <div class="mock-stat-value">482</div>
                                        <div class="mock-stat-subtext"><i class="fas fa-arrow-up"></i> 24 sections</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="mock-stat-card">
                                        <div class="mock-stat-label">Term Fees</div>
                                        <div class="mock-stat-value">₦4.2M</div>
                                        <div class="mock-stat-subtext text-success"><i class="fas fa-wallet"></i> 88% paid</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="mock-stat-card">
                                        <div class="mock-stat-label">Attendance</div>
                                        <div class="mock-stat-value">96.8%</div>
                                        <div class="mock-stat-subtext text-primary"><i class="fas fa-calendar-check"></i> Today</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="mock-stat-card">
                                        <div class="mock-stat-label">Staff</div>
                                        <div class="mock-stat-value">36</div>
                                        <div class="mock-stat-subtext text-muted">Allocated</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Live Student Record Mock Table -->
                            <div class="mock-table-wrapper">
                                <div class="mock-table-header">
                                    <h6><i class="fas fa-user-graduate text-primary me-2"></i>Active Term Students &amp; Fee Status</h6>
                                    <span class="badge bg-light text-dark border">Term 2 • 2026</span>
                                </div>
                                <div class="table-responsive">
                                    <table class="mock-table table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Adm No</th>
                                                <th>Class</th>
                                                <th>Term Fee</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Chinedu Eze</strong></td>
                                                <td><code>AX/2026/014</code></td>
                                                <td>SSS 2 Science</td>
                                                <td>₦75,000</td>
                                                <td><span class="badge-paid"><i class="fas fa-check me-1"></i> Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Amina Bello</strong></td>
                                                <td><code>AX/2026/029</code></td>
                                                <td>JSS 3 Gold</td>
                                                <td>₦65,000</td>
                                                <td><span class="badge-paid"><i class="fas fa-check me-1"></i> Paid</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Damilola Adebayo</strong></td>
                                                <td><code>AX/2026/088</code></td>
                                                <td>SSS 1 Arts</td>
                                                <td>₦70,000</td>
                                                <td><span class="badge-pending"><i class="fas fa-clock me-1"></i> Partial (₦30k bal)</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ngozi Okeke</strong></td>
                                                <td><code>AX/2026/112</code></td>
                                                <td>JSS 1 Silver</td>
                                                <td>₦65,000</td>
                                                <td><span class="badge-paid"><i class="fas fa-check me-1"></i> Paid</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- =====================================================================
         CORE WORKFLOW / FEATURE HIGHLIGHTS
         ===================================================================== -->
    <section class="section-padding" id="features">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-eyebrow">Purpose-Built Architecture</div>
                <h2 class="section-heading">Everything needed to run an organized school</h2>
                <p class="section-description">
                    We designed SchoolCloud school management system around the practical realities of Nigerian school administration: academic sessions, term calendars, continuous assessment splits, and dependable bursary records.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4>Session &amp; Term Management</h4>
                        <p>Configure multiple academic years, activate terms with custom start/end dates, and manage session rollover seamlessly without overwriting past history.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-card-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h4>Continuous Assessment &amp; Grading</h4>
                        <p>Configure CA weights (e.g. Test 1 20%, Test 2 20%, Exam 60%) per subject. Teachers enter marks quickly while the engine calculates totals and positions automatically.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-card-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h4>Batch Report Card Generation</h4>
                        <p>Download single student terminal result sheets or generate an entire section's report cards in one clean batch PDF ready for distribution or parent review.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-card-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h4>Bursary &amp; Fee Invoicing</h4>
                        <p>Define tuition and levy structures by class level. Issue invoices, record bank transfers or cash payments, track debts, and print verifiable receipts in Naira (₦).</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Family &amp; Parent Portal</h4>
                        <p>Parents link multiple children to one login. They can monitor term performance, view daily attendance, check outstanding fees, and message teachers directly.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-card-icon">
                            <i class="fas fa-file-excel"></i>
                        </div>
                        <h4>Student CSV Import &amp; Export</h4>
                        <p>Onboard hundreds of students in minutes. Download our formatted Excel/CSV template, paste your school roster, and upload with auto-generated admission numbers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         STAKEHOLDER ROLE SWITCHER (INTERACTIVE TABS)
         ===================================================================== -->
    <section class="section-padding bg-light" id="roles">
        <div class="container">
            <div class="text-center mb-4">
                <div class="section-eyebrow">Dedicated Experiences</div>
                <h2 class="section-heading">Tailored portals for every member of your school</h2>
                <p class="section-description">
                    Each stakeholder gets a focused dashboard designed for their specific daily duties — with strict role-based data protection.
                </p>
            </div>

            <!-- Role Pills Navigation -->
            <div class="text-center">
                <div class="role-pills-nav" role="tablist">
                    <button class="role-pill-btn active" id="pill-admin-tab" data-bs-toggle="pill" data-bs-target="#pill-admin" type="button" role="tab">
                        <span>School Administrators</span>
                    </button>
                    <button class="role-pill-btn" id="pill-teachers-tab" data-bs-toggle="pill" data-bs-target="#pill-teachers" type="button" role="tab">
                        <span>Teachers &amp; Form Masters</span>
                    </button>
                    <button class="role-pill-btn" id="pill-bursars-tab" data-bs-toggle="pill" data-bs-target="#pill-bursars" type="button" role="tab">
                        <span>Bursars &amp; Accountants</span>
                    </button>
                    <button class="role-pill-btn" id="pill-parents-tab" data-bs-toggle="pill" data-bs-target="#pill-parents" type="button" role="tab">
                        <span>Parents &amp; Guardians</span>
                    </button>
                    <button class="role-pill-btn" id="pill-students-tab" data-bs-toggle="pill" data-bs-target="#pill-students" type="button" role="tab">
                        <span>Students &amp; Learners</span>
                    </button>
                </div>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content" id="rolePillsContent">
                <!-- Admin Tab -->
                <div class="tab-pane fade show active" id="pill-admin" role="tabpanel">
                    <div class="role-card-box">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6">
                                <span class="badge bg-primary-subtle text-primary fw-bold mb-2">School Administration</span>
                                <h3 class="mb-3">Complete oversight over academic operations</h3>
                                <p class="text-muted mb-4">
                                    Proprietors and principals have complete command over their institution's academic structure, staff allocations, and student population.
                                </p>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-sitemap"></i></div>
                                    <div>
                                        <strong>Class &amp; Section Allocation</strong>
                                        <p class="text-muted mb-0 small">Assign form masters and subject teachers to specific sections with granular permission controls.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-id-card"></i></div>
                                    <div>
                                        <strong>Automated Admission Number Generator</strong>
                                        <p class="text-muted mb-0 small">Produce standardized student admission formats (e.g. <code>CRA/2026/001</code>) instantly during intake.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-bullhorn"></i></div>
                                    <div>
                                        <strong>School-Wide Announcements</strong>
                                        <p class="text-muted mb-0 small">Publish notices for staff, students, and parents with priority in-app and email delivery.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border rounded-3 p-4 bg-white shadow-sm">
                                    <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-tasks text-primary me-2"></i>Admin Quick Actions</h6>
                                    <div class="list-group list-group-flush small">
                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0">
                                            <span><i class="fas fa-calendar-check text-success me-2"></i> Current Session</span>
                                            <span class="badge bg-light text-dark border">2025/2026 • 2nd Term</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0">
                                            <span><i class="fas fa-users text-primary me-2"></i> Total Enrolled</span>
                                            <span class="fw-bold">482 Active Students</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0">
                                            <span><i class="fas fa-file-export text-info me-2"></i> Student Roster Export</span>
                                            <span class="text-primary fw-semibold">CSV / Excel Ready</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-0">
                                            <span><i class="fas fa-bell text-warning me-2"></i> Pending Admissions</span>
                                            <span class="badge bg-warning-subtle text-warning-emphasis">6 Awaiting Approval</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teachers Tab -->
                <div class="tab-pane fade" id="pill-teachers" role="tabpanel">
                    <div class="role-card-box">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6">
                                <span class="badge bg-success-subtle text-success fw-bold mb-2">Teacher &amp; Form Master Portal</span>
                                <h3 class="mb-3">Fast grade entry without spreadsheet errors</h3>
                                <p class="text-muted mb-4">
                                    Teachers focus on teaching. Entering test scores, recording daily attendance, and submitting terminal comments takes minutes instead of late nights.
                                </p>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-edit"></i></div>
                                    <div>
                                        <strong>Spreadsheet-Style Grade Input</strong>
                                        <p class="text-muted mb-0 small">Input CA1, CA2, assignments, and exam marks on one screen with real-time total updates.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-user-check"></i></div>
                                    <div>
                                        <strong>Daily Morning &amp; Afternoon Attendance</strong>
                                        <p class="text-muted mb-0 small">Mark roll call with one click (Mark All Present, toggle absents) from any phone or computer.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-comment-dots"></i></div>
                                    <div>
                                        <strong>Direct Parent Communication</strong>
                                        <p class="text-muted mb-0 small">Send messages directly to individual parents regarding academic performance or behavior.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border rounded-3 p-4 bg-white shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-pen-square text-success me-2"></i>Grade Input: Basic Science (JSS 2A)</h6>
                                        <span class="badge bg-success">Draft Saved</span>
                                    </div>
                                    <table class="table table-sm table-bordered small mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Student</th>
                                                <th>CA1 (20)</th>
                                                <th>CA2 (20)</th>
                                                <th>Exam (60)</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Chinedu Eze</td>
                                                <td><span class="badge bg-light text-dark border">18</span></td>
                                                <td><span class="badge bg-light text-dark border">17</span></td>
                                                <td><span class="badge bg-light text-dark border">54</span></td>
                                                <td><strong class="text-success">89% (A1)</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Amina Bello</td>
                                                <td><span class="badge bg-light text-dark border">16</span></td>
                                                <td><span class="badge bg-light text-dark border">15</span></td>
                                                <td><span class="badge bg-light text-dark border">48</span></td>
                                                <td><strong class="text-primary">79% (B2)</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Damilola Adebayo</td>
                                                <td><span class="badge bg-light text-dark border">14</span></td>
                                                <td><span class="badge bg-light text-dark border">16</span></td>
                                                <td><span class="badge bg-light text-dark border">42</span></td>
                                                <td><strong class="text-dark">72% (B3)</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bursar Tab -->
                <div class="tab-pane fade" id="pill-bursars" role="tabpanel">
                    <div class="role-card-box">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6">
                                <span class="badge bg-warning-subtle text-warning-emphasis fw-bold mb-2">Bursary &amp; Accounts</span>
                                <h3 class="mb-3">Clean financial books &amp; fee collection</h3>
                                <p class="text-muted mb-4">
                                    Gain complete control over fee schedules, term invoicing, payment verification, and debtors lists with clear audit logs.
                                </p>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                    <div>
                                        <strong>Batch Invoicing by Class</strong>
                                        <p class="text-muted mb-0 small">Generate invoices for an entire class level (Tuition, Development, ICT, Uniforms) in one click.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-receipt"></i></div>
                                    <div>
                                        <strong>Official Payment Receipts</strong>
                                        <p class="text-muted mb-0 small">Record bank transfers, POS or cash payments and generate branded, numbered receipts instantly.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-chart-line"></i></div>
                                    <div>
                                        <strong>Financial Reconciliation Reports</strong>
                                        <p class="text-muted mb-0 small">Export income summaries, outstanding balance reports, and payment logs directly to Excel.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border rounded-3 p-4 bg-white shadow-sm">
                                    <h6 class="fw-bold mb-3 text-dark"><i class="fas fa-wallet text-warning me-2"></i>Term Fee Breakdown (JSS 1)</h6>
                                    <ul class="list-group list-group-flush small mb-3">
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>Tuition Fee</span>
                                            <strong>₦45,000</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>Development Levy</span>
                                            <strong>₦10,000</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between px-0">
                                            <span>ICT / Computer Practical</span>
                                            <strong>₦5,000</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between px-0 bg-light p-2 rounded">
                                            <span class="fw-bold">Total Term Invoice</span>
                                            <span class="fw-bold text-success">₦60,000</span>
                                        </li>
                                    </ul>
                                    <div class="alert alert-success py-2 px-3 mb-0 small">
                                        <i class="fas fa-check-circle me-1"></i> Receipts include unique invoice reference &amp; student matric number.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Parents Tab -->
                <div class="tab-pane fade" id="pill-parents" role="tabpanel">
                    <div class="role-card-box">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6">
                                <span class="badge bg-info-subtle text-info-emphasis fw-bold mb-2">Family &amp; Parent Portal</span>
                                <h3 class="mb-3">Stay informed on your children's progress</h3>
                                <p class="text-muted mb-4">
                                    Parents receive transparent access to their children's school journey, whether they have one child or four in different classes.
                                </p>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-user-friends"></i></div>
                                    <div>
                                        <strong>Multi-Child Account Linking</strong>
                                        <p class="text-muted mb-0 small">Toggle between siblings with a single tap without needing separate login credentials.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-file-download"></i></div>
                                    <div>
                                        <strong>Instant Report Card Downloads</strong>
                                        <p class="text-muted mb-0 small">Access verified terminal result sheets anytime without waiting for paper reports to be carried home.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-money-check-alt"></i></div>
                                    <div>
                                        <strong>Fee Transparency &amp; Receipts</strong>
                                        <p class="text-muted mb-0 small">Review paid invoices, current term outstanding balances, and official payment history.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border rounded-3 p-4 bg-white shadow-sm">
                                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                        <div class="rounded-circle bg-primary-subtle text-primary p-3 fw-bold">
                                            MO
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Mr. Michael Okafor (Parent)</h6>
                                            <span class="text-muted small">2 Children Linked: Chinedu (SSS 2), Somto (JSS 1)</span>
                                        </div>
                                    </div>
                                    <div class="bg-light p-3 rounded-2 small mb-2">
                                        <div class="d-flex justify-content-between mb-1">
                                            <strong class="text-primary">Chinedu Okafor</strong>
                                            <span class="badge bg-success">Position: 3rd / 34</span>
                                        </div>
                                        <div class="text-muted">Attendance: 98% • Terminal Average: 82.4%</div>
                                    </div>
                                    <div class="bg-light p-3 rounded-2 small">
                                        <div class="d-flex justify-content-between mb-1">
                                            <strong class="text-primary" >Somto Okafor</strong>
                                            <span class="badge bg-success">Position: 1st / 38</span>
                                        </div>
                                        <div class="text-muted">Attendance: 100% • Terminal Average: 89.1%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Tab -->
                <div class="tab-pane fade" id="pill-students" role="tabpanel">
                    <div class="role-card-box">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6">
                                <span class="badge bg-purple-subtle text-purple fw-bold mb-2" style="background-color: #f3e8ff; color: #7e22ce;">Student &amp; Learner Portal</span>
                                <h3 class="mb-3">Take ownership of your academic performance</h3>
                                <p class="text-muted mb-4">
                                    Students get direct, transparent access to their continuous assessments, published terminal result sheets, attendance logs, and class timetables.
                                </p>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-graduation-cap"></i></div>
                                    <div>
                                        <strong>Real-Time Result Checking</strong>
                                        <p class="text-muted mb-0 small">Access CA scores and approved exam marks instantly without waiting for physical report card distribution.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-calendar-alt"></i></div>
                                    <div>
                                        <strong>Daily Timetable &amp; Schedules</strong>
                                        <p class="text-muted mb-0 small">Check daily subject schedules, lab practical periods, and teacher assignments from any phone or tablet.</p>
                                    </div>
                                </div>
                                <div class="role-feature-item">
                                    <div class="role-feature-icon"><i class="fas fa-award"></i></div>
                                    <div>
                                        <strong>Academic Milestones &amp; Attendance</strong>
                                        <p class="text-muted mb-0 small">Monitor roll-call records, personal term attendance percentages, and subject position progress.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border rounded-3 p-4 bg-white shadow-sm">
                                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                        <div class="rounded-circle fw-bold" style="width: 46px; height: 46px; display: flex; align-items: center; justify-content: center; background-color: #f3e8ff; color: #7e22ce;">
                                            DA
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0 fw-bold text-dark">David Adeleke</h6>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle">Active Student</span>
                                            </div>
                                            <span class="text-muted small">SSS 2 Science • CRA/2024/089</span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="small text-muted fw-semibold">Current Term Performance</span>
                                            <span class="badge bg-primary">Term 2 • Published</span>
                                        </div>
                                        <table class="table table-sm table-bordered small mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Subject</th>
                                                    <th>CA (40)</th>
                                                    <th>Exam (60)</th>
                                                    <th>Total</th>
                                                    <th>Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Mathematics</td>
                                                    <td><span class="badge bg-light text-dark border">36</span></td>
                                                    <td><span class="badge bg-light text-dark border">54</span></td>
                                                    <td><strong>90%</strong></td>
                                                    <td><span class="text-success fw-bold">A1</span></td>
                                                </tr>
                                                <tr>
                                                    <td>English Language</td>
                                                    <td><span class="badge bg-light text-dark border">34</span></td>
                                                    <td><span class="badge bg-light text-dark border">48</span></td>
                                                    <td><strong>82%</strong></td>
                                                    <td><span class="text-primary fw-bold">B2</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Physics</td>
                                                    <td><span class="badge bg-light text-dark border">35</span></td>
                                                    <td><span class="badge bg-light text-dark border">51</span></td>
                                                    <td><strong>86%</strong></td>
                                                    <td><span class="text-success fw-bold">A1</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light small">
                                        <span><i class="fas fa-chart-line text-primary me-1"></i> Class Rank: <strong>2nd of 42</strong></span>
                                        <span><i class="fas fa-check-circle text-success me-1"></i> Attendance: <strong>97.5%</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         DEEP DIVE: AUTOMATED REPORT CARD ENGINE
         ===================================================================== -->
    <section class="section-padding" id="report-cards">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="section-eyebrow">Zero End-of-Term Chaos</div>
                    <h2 class="section-heading">Automated report cards that look beautiful and professional</h2>
                    <p class="section-description text-start mb-4">
                        Say goodbye to calculation errors, missing exam sheets, and late-night manual compiling. SchoolCloud SMS compiles subject scores, calculates percentage averages, assigns letter grades, and generates official printable PDFs in seconds.
                    </p>

                    <div class="mb-4">
                        <div class="d-flex gap-3 mb-3">
                            <i class="fas fa-check-circle text-success fs-5 mt-1"></i>
                            <div>
                                <strong>Configurable CA Breakdown</strong>
                                <p class="text-muted small mb-0">Easily split between Test 1 (20%), Test 2 (20%), and Terminal Exam (60%), or your school's unique weighting.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <i class="fas fa-check-circle text-success fs-5 mt-1"></i>
                            <div>
                                <strong>Automated Positions &amp; Class Averages</strong>
                                <p class="text-muted small mb-0">Ranks student terminal totals accurately with tie-breaking rules and class benchmarks.</p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 mb-3">
                            <i class="fas fa-check-circle text-success fs-5 mt-1"></i>
                            <div>
                                <strong>Batch Download Entire Section</strong>
                                <p class="text-muted mb-0 small">Download all report cards for JSS 1 or SSS 3 in a single aggregated PDF for high-speed printing.</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('school.register') }}" class="btn btn-brand-primary">
                        Setup Your Grading System
                    </a>
                </div>

                <!-- Authentic Report Card Sheet Mockup -->
                <div class="col-lg-7">
                    <div class="report-card-mock">
                        <div class="report-header-banner">
                            <div class="report-school-name">GREENFIELD INTERNATIONAL ACADEMY</div>
                            <div class="report-sheet-title">Continuous Assessment &amp; Terminal Report Sheet</div>
                            <div class="text-muted small">Academic Session: 2025/2026 • Second Term</div>
                        </div>

                        <div class="report-meta-grid">
                            <div><strong>Student:</strong> Chinedu Daniel Eze</div>
                            <div><strong>Admission No:</strong> AX/2026/0412</div>
                            <div><strong>Class:</strong> JSS 2 (Gold Section)</div>
                            <div><strong>Class Population:</strong> 35 Students</div>
                            <div><strong>Terminal Position:</strong> <span class="badge bg-primary text-white">2nd of 35</span></div>
                            <div><strong>Term Average:</strong> <strong class="text-success">86.2%</strong></div>
                        </div>

                        <div class="table-responsive">
                            <table class="report-table">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>CA 1 (20)</th>
                                        <th>CA 2 (20)</th>
                                        <th>Exam (60)</th>
                                        <th>Total (100)</th>
                                        <th>Grade</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mathematics</td>
                                        <td>18</td>
                                        <td>19</td>
                                        <td>52</td>
                                        <td><strong>89</strong></td>
                                        <td><span class="grade-badge-a">A1</span></td>
                                        <td class="small">Excellent</td>
                                    </tr>
                                    <tr>
                                        <td>English Language</td>
                                        <td>17</td>
                                        <td>16</td>
                                        <td>49</td>
                                        <td><strong>82</strong></td>
                                        <td><span class="grade-badge-a">A1</span></td>
                                        <td class="small">Very Good</td>
                                    </tr>
                                    <tr>
                                        <td>Basic Science</td>
                                        <td>19</td>
                                        <td>18</td>
                                        <td>54</td>
                                        <td><strong>91</strong></td>
                                        <td><span class="grade-badge-a">A1</span></td>
                                        <td class="small">Distinction</td>
                                    </tr>
                                    <tr>
                                        <td>Civic Education</td>
                                        <td>16</td>
                                        <td>17</td>
                                        <td>46</td>
                                        <td><strong>79</strong></td>
                                        <td><span class="grade-badge-b">B2</span></td>
                                        <td class="small">Commendable</td>
                                    </tr>
                                    <tr>
                                        <td>Computer Studies</td>
                                        <td>20</td>
                                        <td>19</td>
                                        <td>52</td>
                                        <td><strong>91</strong></td>
                                        <td><span class="grade-badge-a">A1</span></td>
                                        <td class="small">Distinction</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-light p-2 rounded small mb-3 border">
                            <strong>Form Master Remark:</strong> <em>"Chinedu shows exceptional leadership and academic consistency. Recommended for promotional honours."</em>
                        </div>

                        <div class="report-seal-row">
                            <div class="small text-muted">
                                Principal's Sign-off: <strong class="text-dark">Approved &amp; Verified</strong>
                            </div>
                            <div class="official-seal">
                                <i class="fas fa-stamp me-1"></i> SchoolCloud SMS Verified Stamp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         DEEP DIVE: BURSARY & FINANCIAL CLARITY
         ===================================================================== -->
    <section class="section-padding bg-light" id="bursary">
        <div class="container">
            <div class="row align-items-center g-5 flex-lg-row-reverse">
                <div class="col-lg-5">
                    <div class="section-eyebrow">Financial Accuracy</div>
                    <h2 class="section-heading">No more uncollected school fees or lost bank tellers</h2>
                    <p class="section-description text-start mb-4">
                        SchoolCloud SMS gives school directors and bursars total transparency over school revenue. Know who has paid, who owes, and reconcile cash or direct bank transfers with verifiable digital receipts.
                    </p>

                    <ul class="list-unstyled mb-4">
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <i class="fas fa-check-circle text-primary fs-5 mt-1"></i>
                            <div>
                                <strong>Class-Based Fee Structure</strong>
                                <p class="text-muted small mb-0">Differentiate nursery, primary, junior, and senior secondary fee rates with itemized line items.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <i class="fas fa-check-circle text-primary fs-5 mt-1"></i>
                            <div>
                                <strong>Partial Payments &amp; Installments</strong>
                                <p class="text-muted small mb-0">Record partial installments easily. The system tracks remaining balances automatically.</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3 mb-3">
                            <i class="fas fa-check-circle text-primary fs-5 mt-1"></i>
                            <div>
                                <strong>Instant Printable Receipts</strong>
                                <p class="text-muted small mb-0">Generate official school receipts containing school logo, stamp, and payment reference numbers.</p>
                            </div>
                        </li>
                    </ul>

                    <a href="{{ route('school.register') }}" class="btn btn-brand-primary">
                        Start Free School Trial
                    </a>
                </div>

                <div class="col-lg-7">
                    <div class="border rounded-4 p-4 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom">
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">Bursary Payment Receipt</h5>
                                <span class="text-muted small">Receipt #RCP-2026-0849 • Date: Oct 12, 2026</span>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fw-bold">
                                <i class="fas fa-check-double me-1"></i> FULL PAYMENT CONFIRMED
                            </span>
                        </div>

                        <div class="row g-3 mb-4 small">
                            <div class="col-6">
                                <div class="text-muted">Paid For:</div>
                                <div class="fw-bold text-dark">Amina Bello (JSS 3 Gold)</div>
                                <div class="text-muted">Admission No: AX/2026/029</div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="text-muted">Payment Channel:</div>
                                <div class="fw-bold text-dark">Direct Bank Transfer</div>
                                <div class="text-muted">Ref: GTB-TRF-9823419</div>
                            </div>
                        </div>

                        <table class="table table-sm table-bordered small mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th>Item Description</th>
                                    <th class="text-end">Amount (₦)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2nd Term Tuition Fee</td>
                                    <td class="text-end">₦45,000</td>
                                </tr>
                                <tr>
                                    <td>PTA Term Levy</td>
                                    <td class="text-end">₦5,000</td>
                                </tr>
                                <tr>
                                    <td>Science Lab &amp; Practical Fee</td>
                                    <td class="text-end">₦10,000</td>
                                </tr>
                                <tr>
                                    <td>End of Term Examination Fee</td>
                                    <td class="text-end">₦5,000</td>
                                </tr>
                                <tr class="table-light fw-bold">
                                    <td>Total Amount Paid</td>
                                    <td class="text-end text-success fs-6">₦65,000</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between align-items-center small text-muted pt-2 border-top">
                            <div>Issued by: Bursar Office (Crown Academy)</div>
                            <div><i class="fas fa-shield-alt text-success me-1"></i> Tamper-proof record</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         PRICING SECTION (DYNAMIC DATABASE TIERS)
         ===================================================================== -->
    <section class="section-padding" id="pricing">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-eyebrow">Predictable Termly Pricing</div>
                <h2 class="section-heading">Transparent plans built for your school's size</h2>
                <p class="section-description">
                    Pay termly per school. No per-student surprise penalties, no per-teacher extra fees. All core features are included in every tier.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                @if(isset($plans) && $plans->count() > 0)
                    @foreach($plans as $plan)
                        @php
                            $isFeatured = strtolower($plan->name) === 'growth';
                            $maxStudents = $plan->max_students >= 999999 ? 'Unlimited' : 'Up to ' . number_format($plan->max_students);
                        @endphp
                        <div class="col-md-6 col-lg-3">
                            <div class="pricing-card {{ $isFeatured ? 'featured' : '' }}">
                                @if($isFeatured)
                                    <span class="pricing-badge-popular">Most Popular</span>
                                @endif
                                <h3 class="pricing-name">{{ $plan->name }}</h3>
                                <div class="pricing-capacity"><i class="fas fa-user-friends me-1"></i> {{ $maxStudents }} Students</div>

                                <div class="my-3">
                                    <span class="pricing-amount">₦{{ number_format($plan->price) }}</span>
                                    <span class="pricing-period">/ {{ $plan->duration_days }} days (Term)</span>
                                </div>

                                <ul class="pricing-features-list">
                                    <li><i class="fas fa-check"></i> Full Academic Engine</li>
                                    <li><i class="fas fa-check"></i> Unlimited Teacher Accounts</li>
                                    <li><i class="fas fa-check"></i> Automated Report Cards</li>
                                    <li><i class="fas fa-check"></i> Bursary &amp; Fee Invoicing</li>
                                    <li><i class="fas fa-check"></i> Parent &amp; Family Portal</li>
                                    <li><i class="fas fa-check"></i> CSV Student Import/Export</li>
                                    <li><i class="fas fa-check"></i> Daily Attendance Tracking</li>
                                </ul>

                                <a href="{{ route('school.register') }}" class="btn {{ $isFeatured ? 'btn-brand-primary' : 'btn-brand-secondary' }} w-100 mt-auto">
                                    Register School <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Sensible Fallback if database seeder hasn't run --}}
                    <div class="col-md-6 col-lg-3">
                        <div class="pricing-card">
                            <h3 class="pricing-name">Starter</h3>
                            <div class="pricing-capacity"><i class="fas fa-user-friends me-1"></i> Up to 100 Students</div>
                            <div class="my-3">
                                <span class="pricing-amount">₦25,000</span>
                                <span class="pricing-period">/ Term</span>
                            </div>
                            <ul class="pricing-features-list">
                                <li><i class="fas fa-check"></i> Full Academic Engine</li>
                                <li><i class="fas fa-check"></i> Unlimited Teacher Logins</li>
                                <li><i class="fas fa-check"></i> Terminal Report Cards</li>
                                <li><i class="fas fa-check"></i> Bursary &amp; Fee Receipts</li>
                            </ul>
                            <a href="{{ route('school.register') }}" class="btn btn-brand-secondary w-100 mt-auto">Get Started</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="pricing-card featured">
                            <span class="pricing-badge-popular">Most Popular</span>
                            <h3 class="pricing-name">Growth</h3>
                            <div class="pricing-capacity"><i class="fas fa-user-friends me-1"></i> Up to 300 Students</div>
                            <div class="my-3">
                                <span class="pricing-amount">₦50,000</span>
                                <span class="pricing-period">/ Term</span>
                            </div>
                            <ul class="pricing-features-list">
                                <li><i class="fas fa-check"></i> Everything in Starter</li>
                                <li><i class="fas fa-check"></i> Batch PDF Report Generation</li>
                                <li><i class="fas fa-check"></i> Full Parent Portal</li>
                                <li><i class="fas fa-check"></i> Attendance Tracking</li>
                            </ul>
                            <a href="{{ route('school.register') }}" class="btn btn-brand-primary w-100 mt-auto">Get Started</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="pricing-card">
                            <h3 class="pricing-name">Academy</h3>
                            <div class="pricing-capacity"><i class="fas fa-user-friends me-1"></i> Up to 600 Students</div>
                            <div class="my-3">
                                <span class="pricing-amount">₦90,000</span>
                                <span class="pricing-period">/ Term</span>
                            </div>
                            <ul class="pricing-features-list">
                                <li><i class="fas fa-check"></i> Everything in Growth</li>
                                <li><i class="fas fa-check"></i> Multiple Section Tracks</li>
                                <li><i class="fas fa-check"></i> Priority Setup Assistance</li>
                            </ul>
                            <a href="{{ route('school.register') }}" class="btn btn-brand-secondary w-100 mt-auto">Get Started</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="pricing-card">
                            <h3 class="pricing-name">Enterprise</h3>
                            <div class="pricing-capacity"><i class="fas fa-user-friends me-1"></i> Unlimited Students</div>
                            <div class="my-3">
                                <span class="pricing-amount">₦150,000</span>
                                <span class="pricing-period">/ Term</span>
                            </div>
                            <ul class="pricing-features-list">
                                <li><i class="fas fa-check"></i> Unlimited Everything</li>
                                <li><i class="fas fa-check"></i> Custom Domain Support</li>
                                <li><i class="fas fa-check"></i> Dedicated Account Manager</li>
                            </ul>
                            <a href="{{ route('school.register') }}" class="btn btn-brand-secondary w-100 mt-auto">Get Started</a>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center mt-4">
                <p class="text-muted small">
                    <i class="fas fa-lock me-1"></i> No setup fee. You can start registering your school immediately and pay only when you activate your term subscription.
                </p>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         FAQ SECTION
         ===================================================================== -->
    <section class="section-padding bg-light" id="faq">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-eyebrow">Clear Answers</div>
                <h2 class="section-heading">Frequently Asked Questions</h2>
                <p class="section-description">
                    Everything you need to know about setting up and operating SchoolCloud SMS in your school.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion landing-accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Can we import our existing student roster from Excel?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Under the Student Admission section, admins can download a standardized CSV/Excel template, fill in student names, guardian details, and class assignments, and upload them in one batch. The system assigns unique admission numbers automatically.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How does the Continuous Assessment (CA) weighting work?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You have complete control over your assessment scheme. You can configure Test 1, Test 2, Assignments, and Terminal Examination weights (e.g. 20 + 20 + 60 = 100%, or 30 + 70 = 100%). When teachers enter marks, total scores and letter grades (A1, B2, C4, etc.) calculate automatically.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Can we generate report cards for an entire class at once?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. While teachers or parents can download individual student report cards, School Administrators can download a complete batch PDF containing every student in a chosen class or section with one click.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How do parents access their children's records?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Admins or parents register an account, and children are linked to the parent via their student admission number. Once logged in, parents see terminal results, daily attendance records, outstanding fee balances, and can communicate directly with teachers.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Can our bursar issue printed or digital receipts for bank transfers?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes. Whenever a bursar logs a payment (cash, POS, or direct bank transfer), SchoolCloud SMS generates an official digital receipt with an invoice reference number and breakdown of items paid. Receipts can be printed or viewed online by parents.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    What happens at the end of an academic session when students promote?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    SchoolCloud SMS supports academic session rollovers. When moving from one session to the next (e.g. 2025/2026 to 2026/2027), all previous student grades, report cards, and fee receipts remain securely archived and accessible in historical records.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         CONVERSION CALL-TO-ACTION BANNER
         ===================================================================== -->
    <section class="container my-5">
        <div class="cta-banner">
            <h2>Ready to bring order &amp; efficiency to your school?</h2>
            <p>
                Join progressive primary and secondary schools that have eliminated report card stress and simplified fee tracking with SchoolCloud SMS.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('school.register') }}" class="btn btn-light btn-lg px-4 py-3 fw-bold text-dark">
                    Register Your School Now
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                    Access Existing Portal
                </a>
            </div>
        </div>
    </section>


    <!-- =====================================================================
         FOOTER
         ===================================================================== -->
    <footer class="footer-landing">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="brand-badge text-white mb-3">
                        <img src="{{ asset('dist/img/axia-logo.svg') }}" alt="SchoolCloud SMS Logo" width="32" height="32">
                        <span>SchoolCloudSMS</span>
                    </div>
                    <p class="text-secondary small mb-3">
                        The comprehensive school management platform built for modern primary and secondary educational institutions.
                    </p>
                    <div class="text-secondary small mb-3">
                        <i class="fas fa-envelope me-2"></i> support@SchoolCloudsms.app
                    </div>

                    <!-- Social Media Links -->
                    <div class="footer-socials" aria-label="Social Media Links">
                        <a href="https://facebook.com" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="Facebook" title="Follow us on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://instagram.com" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="Instagram" title="Follow us on Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://x.com" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)" title="Follow us on X">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://youtube.com" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="YouTube" title="Subscribe on YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://linkedin.com" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" title="Connect on LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <div class="col-6 col-md-3 col-lg-2">
                    <div class="footer-heading">Portals</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}">School Admin</a></li>
                        <li><a href="{{ route('login') }}">Teacher Portal</a></li>
                        <li><a href="{{ route('login') }}">Bursary Portal</a></li>
                        <li><a href="{{ route('login') }}">Parent Portal</a></li>
                        <li><a href="{{ route('login') }}">Student Portal</a></li>
                    </ul>
                </div>

                <div class="col-6 col-md-3 col-lg-3">
                    <div class="footer-heading">Product</div>
                    <ul class="footer-links">
                        <li><a href="#features">Academic Engine</a></li>
                        <li><a href="#report-cards">Terminal Report Cards</a></li>
                        <li><a href="#bursary">Bursary &amp; Fee Invoicing</a></li>
                        <li><a href="#pricing">Termly Pricing Plans</a></li>
                        <li><a href="{{ route('school.register') }}">School Registration</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="footer-heading">Security &amp; Standards</div>
                    <p class="text-secondary small mb-2">
                        Tenant-isolated databases, role-restricted access, and SSL encryption protect all sensitive student and financial records.
                    </p>
                    <div class="badge bg-secondary text-light border border-secondary p-2">
                        <i class="fas fa-lock me-1"></i> Multi-tenant data isolation
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div>
                    &copy; {{ date('Y') }} SchoolCloud SMS. All rights reserved.
                </div>
                <div class="d-flex gap-3">
                    <a href="#topNav">Back to top <i class="fas fa-arrow-up ms-1"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 Bundle JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Role Pills Auto-Slider Controller -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleNav = document.querySelector('.role-pills-nav');
            const roleSection = document.getElementById('roles');
            if (!roleNav || !roleSection) return;

            const tabButtons = Array.from(roleNav.querySelectorAll('button[data-bs-toggle="pill"]'));
            if (!tabButtons.length) return;

            let currentIndex = tabButtons.findIndex(btn => btn.classList.contains('active'));
            if (currentIndex === -1) currentIndex = 0;

            let slideInterval = null;
            let isPaused = false;
            const DURATION = 3000; // 3 seconds per slide

            function switchTab(index) {
                currentIndex = (index + tabButtons.length) % tabButtons.length;
                const targetBtn = tabButtons[currentIndex];
                if (targetBtn && window.bootstrap && window.bootstrap.Tab) {
                    const tabInstance = bootstrap.Tab.getOrCreateInstance(targetBtn);
                    tabInstance.show();
                }
            }

            function nextTab() {
                if (!isPaused) {
                    switchTab(currentIndex + 1);
                }
            }

            function startAutoSlide() {
                stopAutoSlide();
                slideInterval = setInterval(nextTab, DURATION);
            }

            function stopAutoSlide() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                    slideInterval = null;
                }
            }

            // Sync index when a tab is shown
            tabButtons.forEach((btn, index) => {
                btn.addEventListener('shown.bs.tab', function () {
                    currentIndex = index;
                });

                btn.addEventListener('click', function () {
                    currentIndex = index;
                    startAutoSlide();
                });
            });

            // Pause on hover
            roleSection.addEventListener('mouseenter', function () {
                isPaused = true;
            });
            roleSection.addEventListener('mouseleave', function () {
                isPaused = false;
            });

            // Mobile touch interactions
            roleSection.addEventListener('touchstart', function () {
                isPaused = true;
            }, { passive: true });
            roleSection.addEventListener('touchend', function () {
                setTimeout(function () {
                    isPaused = false;
                }, 3000);
            }, { passive: true });

            startAutoSlide();
        });
    </script>

</body>
</html>
