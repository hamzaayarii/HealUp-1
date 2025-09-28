<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class HealthTrackerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user
        $this->user = User::factory()->create([
            'email' => 'test@healup.com',
            'role' => 'student'
        ]);
    }

    /** @test */
    public function user_can_access_health_dashboard()
    {
        $response = $this->actingAs($this->user)
            ->get('/health');

        $response->assertStatus(200);
        $response->assertViewIs('health.dashboard.index');
    }

    /** @test */
    public function user_can_view_habits_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/habits');

        $response->assertStatus(200);
        $response->assertViewIs('health.habits.index');
    }

    /** @test */
    public function user_can_access_create_habit_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/habits/create');

        $response->assertStatus(200);
        $response->assertViewIs('health.habits.create');
    }

    /** @test */
    public function user_can_access_progress_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/progress');

        $response->assertStatus(200);
        $response->assertViewIs('health.progress.index');
    }

    /** @test */
    public function user_can_access_reports_page()
    {
        $response = $this->actingAs($this->user)
            ->get('/health/reports');

        $response->assertStatus(200);
        $response->assertViewIs('health.reports.index');
    }

    /** @test */
    public function guest_cannot_access_health_pages()
    {
        $response = $this->get('/health');
        $response->assertRedirect('/login');

        $response = $this->get('/habits');
        $response->assertRedirect('/login');

        $response = $this->get('/progress');
        $response->assertRedirect('/login');

        $response = $this->get('/health/reports');
        $response->assertRedirect('/login');
    }
}
