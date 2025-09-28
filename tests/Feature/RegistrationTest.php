<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        if (!Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function test_new_users_can_register(): void
    {
        if (!Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'student',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_user_role_is_set_correctly_based_on_user_type(): void
    {
        if (!Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        // Test student registration
        $this->post('/register', [
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'student',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $student = User::where('email', 'student@example.com')->first();
        $this->assertEquals('student', $student->role);
        $this->assertTrue($student->isStudent());

        // Logout and test teacher registration
        $this->post(route('logout'));

        $this->post('/register', [
            'name' => 'Test Teacher',
            'email' => 'teacher@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => 'teacher',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $teacher = User::where('email', 'teacher@example.com')->first();
        $this->assertEquals('professor', $teacher->role);
        $this->assertTrue($teacher->isProfessor());
    }
}
