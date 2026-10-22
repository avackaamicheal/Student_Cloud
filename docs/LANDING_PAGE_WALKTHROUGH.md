# SchoolCloud SMS - Landing Page Walkthrough & Architecture Reference

This document records the design, implementation, late changes, and verification for the **SchoolCloud SMS** landing page. It is stored directly in the repository for future reference.

---

## 1. Project Background & Requirements

- **Framework**: Laravel 12 with Blade templates.
- **Styling**: Bootstrap 5.3 + bespoke CSS design system (`public/css/landing.css`).
- **Core Directive**: *"Let it not look like AI"* — avoid generic, cliché AI landing page styles (dark mode with glowing purple/pink radial orbs, floating 3D spheres, empty buzzwords like "supercharge next-gen synergy").
- **Authentic Domain Focus**: Grounded in the day-to-day realities of Nigerian primary and secondary schools:
  - Continuous Assessment (CA) weighting: Test 1 (20%), Test 2 (20%), Exam (60%).
  - Terminal report card generation with positions (`2nd of 35`), percentage averages, letter grades (`A1`, `B2`), remarks, and principal approval stamps.
  - Bursary fee structures and invoicing in Nigerian Naira (`₦`) with verifiable receipt reference numbers.
  - Multi-child family portal linking for parents.
  - Dynamic subscription plans loaded from the database (`SubscriptionPlan`).

---

## 2. Implemented Components

```
sms/
├── app/
│   ├── Http/
│   │   └── Middleware/
│   │       └── CheckSchoolApproval.php    # Whitelisted 'landing' route from subscription intercept
│   └── Models/
│       └── User.php                       # Added dashboardUrl() helper method for all roles
├── routes/
│   └── web.php                            # Updated '/' route to render landing view with try/catch
├── resources/
│   └── views/
│       └── landing.blade.php              # Full semantic Bootstrap 5 landing page Blade view
├── public/
│   └── css/
│       └── landing.css                    # Handcrafted CSS tokens, UI mockups, dark role card contrast
├── tests/
│   └── Feature/
│       └── LandingPageTest.php            # Feature tests for guest view, dynamic plans, and auth navigation
└── docs/
    └── LANDING_PAGE_WALKTHROUGH.md        # This persistent reference document
```

---

## 3. Key Design Features in `landing.blade.php`

1. **Sticky Header & Contextual Navigation**:
   - Uses `dist/img/SchoolCloud-logo.svg` branding.
   - Smooth-scrolling anchor links: *Features*, *Portals*, *Report Cards*, *Bursary*, *Pricing*, *FAQ*.
   - Dynamic user authentication state:
     - Logged in: Displays user name, role dropdown, and **"Go to Dashboard"** pointing to their specific portal.
     - Guest: Displays **"Sign In"** as an underlined link (`link-dark text-decoration-underline link-offset-3`) with a 2.5px thick underline and 7px text offset, alongside the high-contrast **"Register School"** button.

2. **Hero Section with Realistic Dashboard Mockup**:
   - High-conversion headline: *"Run your entire school with clarity & control."*
   - Trust proof points: *Termly Academic Cycles • Batch PDF Report Cards • Naira (₦) Fee Invoicing • 100% Cloud Accessible*.
   - Browser frame mockup showing actual school metrics (482 Students, ₦4.2M Fees Collected, 96.8% Attendance) and active student roster with fee payment badges.

3. **Role-Based Experience Tabs (`#roles`)**:
   - High-contrast dark container (`#0f172a`) with crisp white headings (`#ffffff`), readable slate descriptions (`#94a3b8`), pure white feature titles (`#f8fafc`), soft indigo icons, and crisp white embedded preview cards on the right column.
   - **Clean Auto-Slider Rotation**: Automatically cycles through the 5 tabs every 3 seconds. All role pill buttons remain distraction-free pills without any progress bars or distracting lines.
   - **Interactive Control**: Tabs remain fully clickable at any moment (resetting the rotation timer), and hover/touch interaction automatically pauses the auto-slide so users can read comfortably.
   - Detailed stakeholder tabs:
     - **School Administrators**: Session & term activations, teacher section allocations, CSV student imports.
     - **Teachers & Form Masters**: Rapid spreadsheet-style mark input, morning/afternoon attendance roll-call.
     - **Bursars & Accountants**: Term fee structures, batch class invoicing, verifiable receipt generator.
     - **Parents & Guardians**: Multi-child family portal, real-time result downloads, fee transparency.
     - **Students & Learners**: Real-time continuous assessment and approved exam scores, class timetables, attendance tracking, and term class rank.

4. **Automated Report Card Showcase (`#report-cards`)**:
   - Shows why end-of-term compiling shouldn't take weeks.
   - Tactile UI preview of Greenfield International Academy's terminal report sheet (Subject rows, CA1, CA2, Exam, Totals, Grades `A1`/`B2`, Form Master remark, and Principal's verification stamp).

5. **Bursary & Fee Management Deep-Dive (`#bursary`)**:
   - Term tuition breakdowns, debt tracking, and an official printable receipt card preview in Naira (`₦`).

6. **Dynamic Pricing Grid (`#pricing`)**:
   - Renders active tiers directly from the database:
     - **Starter**: ₦25,000 / term (Up to 100 students)
     - **Growth**: ₦50,000 / term (Up to 300 students — *Most Popular*)
     - **Academy**: ₦90,000 / term (Up to 600 students)
     - **Enterprise**: ₦150,000 / term (Unlimited students)
   - Graceful fallback cards if database records are empty.

7. **Frequently Asked Questions (`#faq`)**:
   - Bootstrap 5 Accordion answering 6 real school admin questions:
     - Importing student rosters from Excel.
     - Customizing Continuous Assessment weighting.
     - Batch downloading section report cards in PDF.
     - Parent account creation and child linking.
     - Recording bank transfers and issuing digital receipts.
     - Academic session rollover and record archival.

8. **Conversion Banner & Footer**:
   - Direct call-to-action to register new schools.
   - Complete footer links, portal shortcuts, and data security badges.

---

## 4. Late Implementation Refinements & Architecture Fixes

During the execution phase, four critical architectural enhancements were made:

### A. Route Intercept Whitelist in `CheckSchoolApproval`
- **Location**: `app/Http/Middleware/CheckSchoolApproval.php`
- **Issue**: The middleware intercepts authenticated `SchoolAdmin` accounts whose school has not yet activated a subscription and redirects them to `subscription.index`. Without an exemption, visiting `/` was immediately redirected.
- **Fix**: Added `'landing'` to `$allowedRoutes`, allowing school staff to view the marketing page, explore features, and review pricing.

### B. Dynamic User Dashboard Resolver
- **Location**: `app/Models/User.php`
- **Enhancement**: Added `dashboardUrl(): string` helper to inspect user roles and tenant school slug, cleanly routing:
  - SuperAdmin -> `superadmin.dashboard`
  - SchoolAdmin -> `schooladmin.dashboard` (with school slug)
  - Teacher -> `teacher.dashboard` (with school slug)
  - Bursar -> `bursar.dashboard` (with school slug)
  - Parent -> `parent.dashboard` (with school slug)
  - Student -> `student.dashboard` (with school slug)

### C. Resilient Database Query in `routes/web.php`
- **Location**: `routes/web.php`
- **Enhancement**: Wrapped `SubscriptionPlan::where('is_active', true)->get()` in a `try/catch` with fallback to `collect()`. This guarantees the landing page never throws a 500 error during unmigrated test runs or fresh setups.

### D. Automated Feature Test Suite
- **Location**: `tests/Feature/LandingPageTest.php`
- **Coverage**:
  1. `test_landing_page_loads_successfully_for_guest`: Confirms HTTP 200, branding, and core copy.
  2. `test_landing_page_displays_active_subscription_plans`: Validates that active database plans render with formatted Naira prices (`₦25,000`, `₦50,000`).
  3. `test_landing_page_shows_dashboard_link_for_authenticated_admin`: Confirms authenticated school admins see their name and direct dashboard link.

### E. Stakeholder Navigation Cleanup (Removed Progress Bar)
- **Location**: `resources/views/landing.blade.php`, `public/css/landing.css`, `tests/Feature/LandingPageTest.php`
- **Enhancement**:
  - Removed `.role-nav-progress` and `.role-nav-progress-bar` elements, providing an uncluttered, distraction-free appearance.
  - Reverted `.role-pills-nav` padding to symmetrical `0.35rem` and removed unused keyframes from `public/css/landing.css`.
  - Streamlined the JavaScript controller by removing progress animation reflows and listeners.
  - Updated `LandingPageTest.php` with assertions confirming `role-nav-progress`, `role-nav-progress-bar`, and `pill-progress` are not present on the page.

### F. Addition of Students & Learners Portal Tab
- **Location**: `resources/views/landing.blade.php`, `tests/Feature/LandingPageTest.php`
- **Enhancement**:
  - Added `pill-students-tab` to `.role-pills-nav` (`Students & Learners`).
  - Added `#pill-students` tab pane inside `#rolePillsContent` showcasing student continuous assessments, timetable access, and class attendance.
  - Included a realistic learner preview card for *David Adeleke* (SSS 2 Science, `CRA/2024/089`) with subject results (Mathematics, English Language, Physics), term position (`2nd of 42`), and attendance rate (`97.5%`).
  - Added assertions to `LandingPageTest.php` for `Students & Learners`, `pill-students-tab`, and `David Adeleke`.

### G. Footer Social Media Links
- **Location**: `resources/views/landing.blade.php`, `public/css/landing.css`, `tests/Feature/LandingPageTest.php`
- **Enhancement**:
  - Added dedicated social media link buttons in the footer brand column (`col-lg-4`) for Facebook, Instagram, 𝕏 (custom SVG), YouTube, and LinkedIn.
  - Added `.footer-socials` container and `.social-btn` styles with subtle translucent backgrounds, border radius, and smooth hover elevation/glow.
  - Added student portal link to the "Portals" list in the footer navigation.
  - Added automated assertions to `LandingPageTest.php` asserting all 5 social links with accessible labels.

---

## 5. Verification Results

### Automated Tests
Run command:
```bash
php artisan test tests/Feature/LandingPageTest.php tests/Feature/ExampleTest.php
```
Results:
- `Tests\Feature\LandingPageTest`: 3 passed (28 assertions).
- `Tests\Feature\ExampleTest`: 1 passed (1 assertion).
- **Total: 4 passed, 29 assertions (0 failures)**.

### Live Server & Asset Verification
- Running `php artisan serve --port=8000`:
  - `GET /` -> `HTTP/1.1 200 OK`.
  - `GET /css/landing.css` -> `HTTP/1.1 200 OK`.
  - Dynamic subscription plan data confirmed in rendered HTML.
  - Confirmed all 5 stakeholder tabs and all 5 footer social buttons render cleanly.
