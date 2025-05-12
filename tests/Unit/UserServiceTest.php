<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    public function promoteTest()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->userService->promote($user);
        $this->assertEquals('admin', $user->fresh()->role);
    }

    public function demoteTest()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->userService->demote($user);
        $this->assertEquals('user', $user->fresh()->role);
    }

    public function cannotDeleteAdminTest()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $result = $this->userService->delete($user);
        $this->assertEquals('admin_blocked', $result);
    }

    public function deleteUserTest()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->userService->delete($user);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
