<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_loads_successfully_for_guest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SchoolCloud');
        $response->assertSee('Sign In');
        $response->assertSee('link-offset-3');
        $response->assertSee('text-decoration-underline');
        $response->assertSee('Register School');
        $response->assertSee('Continuous Assessment');
        $response->assertSee('Report Cards');
        $response->assertSee('Bursary');
        $response->assertSee('Students &amp; Learners', false);
        $response->assertSee('pill-students-tab');
        $response->assertSee('aria-label="Facebook"', false);
        $response->assertSee('aria-label="Instagram"', false);
        $response->assertSee('aria-label="X (Twitter)"', false);
        $response->assertSee('aria-label="YouTube"', false);
        $response->assertSee('aria-label="LinkedIn"', false);
        $response->assertDontSee('role-nav-progress');
        $response->assertDontSee('role-nav-progress-bar');
        $response->assertDontSee('pill-progress');
    }

    public function test_landing_page_displays_active_subscription_plans(): void
    {
        SubscriptionPlan::create([
            'name' => 'Starter Demo',
            'max_students' => 100,
            'price' => 25000,
            'duration_days' => 90,
            'is_active' => true,
        ]);

        SubscriptionPlan::create([
            'name' => 'Growth Demo',
            'max_students' => 300,
            'price' => 50000,
            'duration_days' => 90,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Starter Demo');
        $response->assertSee('Growth Demo');
        $response->assertSee('₦25,000');
        $response->assertSee('₦50,000');
    }

    public function test_landing_page_shows_dashboard_link_for_authenticated_admin(): void
    {
        Role::firstOrCreate(['name' => 'SchoolAdmin']);

        $school = School::create([
            'name' => 'Crown Academy',
            'email' => 'admin@crown.edu',
            'slug' => 'crown-academy',
            'phone_number' => '08012345678',
            'address' => '12 Education Lane',
            'principal_name' => 'Dr. Adeyemi',
            'is_active' => true,
            'approval_status' => 'approved',
        ]);

        $user = User::create([
            'name' => 'Admin Adeyemi',
            'email' => 'admin@crown.edu',
            'password' => bcrypt('password'),
            'school_id' => $school->id,
        ]);
        $user->assignRole('SchoolAdmin');

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Admin Adeyemi');
        $response->assertSee(route('schooladmin.dashboard', ['school' => 'crown-academy']));
    }
}
