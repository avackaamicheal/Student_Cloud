<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SchoolRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_school_registration_page_loads_with_branding_and_milestones(): void
    {
        $response = $this->get('/register/school');

        $response->assertStatus(200);
        $response->assertSee('SchoolCloud');
        $response->assertSee('Institutional Onboarding');
        $response->assertSee('Setup your school portal in 3 simple steps.');
        $response->assertSee('School Profile');
        $response->assertSee('Administrator');
        $response->assertSee('Security & Submit', false);
        $response->assertSee('School Details');
        $response->assertSee('name="school_name"', false);
        $response->assertSee('name="school_email"', false);
        $response->assertSee('name="school_phone"', false);
        $response->assertSee('name="school_address"', false);
        $response->assertSee('name="principal_name"', false);
        $response->assertSee('name="admin_name"', false);
        $response->assertSee('name="admin_password"', false);
        $response->assertSee('name="admin_password_confirmation"', false);
        $response->assertSee('Back to Home');
        $response->assertSee('Already registered?');
    }

    public function test_school_can_be_registered_successfully(): void
    {
        Role::firstOrCreate(['name' => 'SchoolAdmin']);

        $response = $this->post('/register/school', [
            'school_name' => 'Legacy Model College',
            'school_email' => 'info@legacymodel.edu.ng',
            'school_phone' => '08022334455',
            'school_address' => '10 Victoria Island, Lagos',
            'principal_name' => 'Alhaji Bello',
            'admin_name' => 'Admin Bello',
            'admin_password' => 'SecretPass123',
            'admin_password_confirmation' => 'SecretPass123',
        ]);

        $response->assertRedirect(route('school.register'));
        $response->assertSessionHas('registered', true);

        $this->assertDatabaseHas('schools', [
            'name' => 'Legacy Model College',
            'email' => 'info@legacymodel.edu.ng',
            'slug' => 'legacy-model-college',
            'phone_number' => '08022334455',
            'address' => '10 Victoria Island, Lagos',
            'principal_name' => 'Alhaji Bello',
            'approval_status' => 'pending',
            'is_active' => false,
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Admin Bello',
            'email' => 'info@legacymodel.edu.ng',
        ]);

        $user = User::where('email', 'info@legacymodel.edu.ng')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('SchoolAdmin'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_registration_fails_validation_when_required_fields_missing(): void
    {
        Role::firstOrCreate(['name' => 'SchoolAdmin']);

        $response = $this->post('/register/school', []);

        $response->assertSessionHasErrors([
            'school_name',
            'school_email',
            'school_phone',
            'school_address',
            'principal_name',
            'admin_name',
            'admin_password',
        ]);
        $this->assertGuest();
    }

    public function test_registration_fails_when_passwords_do_not_match(): void
    {
        Role::firstOrCreate(['name' => 'SchoolAdmin']);

        $response = $this->post('/register/school', [
            'school_name' => 'Apex Academy',
            'school_email' => 'info@apex.edu.ng',
            'school_phone' => '08011223344',
            'school_address' => '15 Abuja Way',
            'principal_name' => 'Mr. Clark',
            'admin_name' => 'Admin Clark',
            'admin_password' => 'PassWord123',
            'admin_password_confirmation' => 'DifferentPass456',
        ]);

        $response->assertSessionHasErrors('admin_password');
        $this->assertGuest();
    }
}
