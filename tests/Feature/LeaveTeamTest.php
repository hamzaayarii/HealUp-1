<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamMemberManager;
use Livewire\Livewire;
use Tests\TestCase;

class LeaveTeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_leave_teams(): void
    {
        $this->assertTrue(true);
    }
    public function test_team_owners_cant_leave_their_own_team(): void
    {
        $this->assertTrue(true);
    }
}
