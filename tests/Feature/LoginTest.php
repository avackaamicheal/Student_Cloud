<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders_with_schoolcloud_branding_and_form_controls(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('SchoolCloud');
        $response->assertSee('Sign In to Portal');
        $response->assertSee('Back to Home');
        $response->assertSee('Register School');
        $response->assertSee('Welcome Back');
        $response->assertSee('Portal Authentication');
        $response->assertSee('Assessment & Report Cards', false);
        $response->assertSee('Naira (₦) Bursary & Invoicing', false);
        $response->assertSee('Dedicated Role Portals');
        $response->assertSee('Single Sign-On access for:');
        $response->assertSee('School Admin');
        $response->assertSee('Teacher');
        $response->assertSee('Bursar');
        $response->assertSee('Parent');
        $response->assertSee('Student');
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('name="remember"', false);
        $response->assertSee('password-toggle');
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@schoolcloud.test',
            'password' => bcrypt('correct-password'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@schoolcloud.test',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_superadmin_can_login_and_redirects_to_dashboard(): void
    {
        Role::firstOrCreate(['name' => 'SuperAdmin']);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@schoolcloud.test',
            'password' => bcrypt('password123'),
        ]);
        $user->assignRole('SuperAdmin');

        $response = $this->post('/login', [
            'email' => 'super@schoolcloud.test',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('superadmin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_teacher_can_login_and_redirects_to_school_dashboard(): void
    {
        Role::firstOrCreate(['name' => 'Teacher']);

        $school = School::create([
            'name' => 'Apex High',
            'email' => 'info@apex.edu',
            'slug' => 'apex-high',
            'phone_number' => '08099887766',
            'address' => '54 Knowledge Ave',
            'principal_name' => 'Mrs. Johnson',
            'is_active' => true,
            'approval_status' => 'approved',
        ]);

        $user = User::create([
            'name' => 'Mr. Okafor',
            'email' => 'okafor@apex.edu',
            'password' => bcrypt('teacher123'),
            'school_id' => $school->id,
        ]);
        $user->assignRole('Teacher');

        $response = $this->post('/login', [
            'email' => 'okafor@apex.edu',
            'password' => 'teacher123',
        ]);

        $response->assertRedirect(route('teacher.dashboard', ['school' => 'apex-high']));
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_visiting_login_page_is_redirected(): void
    {
        Role::firstOrCreate(['name' => 'SuperAdmin']);

        $user = User::create([
            'name' => 'Logged User',
            'email' => 'user@schoolcloud.test',
            'password' => bcrypt('password123'),
        ]);
        $user->assignRole('SuperAdmin');

        $response = $this->actingAs($user)->get('/login');

        // Laravel Guest middleware redirects authenticated users
        $response->assertRedirect();
    }
}
