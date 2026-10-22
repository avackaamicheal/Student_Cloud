<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_forgot_password_page_loads_with_schoolcloud_branding(): void
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
        $response->assertSee('SchoolCloud');
        $response->assertSee('Forgot Password?');
        $response->assertSee('Password Recovery');
        $response->assertSee('Back to Sign In');
        $response->assertSee('Send Password Reset Link');
        $response->assertSee('name="email"', false);
    }

    public function test_reset_password_page_loads_with_token_and_schoolcloud_branding(): void
    {
        $response = $this->get('/password/reset/sample-token?email=admin@school.edu.ng');

        $response->assertStatus(200);
        $response->assertSee('SchoolCloud');
        $response->assertSee('Set New Password');
        $response->assertSee('Password Recovery');
        $response->assertSee('Back to Sign In');
        $response->assertSee('Reset Password & Sign In', false);
        $response->assertSee('name="token"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('name="password_confirmation"', false);
    }

    public function test_user_can_request_password_reset_link(): void
    {
        $user = User::factory()->create([
            'email' => 'teacher@schoolcloud.test',
        ]);

        $response = $this->post('/password/email', [
            'email' => 'teacher@schoolcloud.test',
        ]);

        $response->assertSessionHas('status');
    }

    public function test_user_can_reset_password_with_valid_token(): void
    {
        Role::firstOrCreate(['name' => 'SuperAdmin']);

        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@schoolcloud.test',
            'password' => bcrypt('old-password-123'),
        ]);
        $user->assignRole('SuperAdmin');

        $token = Password::broker()->createToken($user);

        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => 'admin@schoolcloud.test',
            'password' => 'new-secure-password-456',
            'password_confirmation' => 'new-secure-password-456',
        ]);

        $response->assertRedirect();

        $user->refresh();
        $this->assertTrue(Hash::check('new-secure-password-456', $user->password));
    }
}
