<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCaseFeature;

class UserControllerTest extends TestCaseFeature
{
    use RefreshDatabase;

    public function test_can_list_users()
    {
        User::factory()->create(['name' => 'Test User']);

        $response = $this->get('/admin/users');

        $response->assertStatus(200)
            ->assertSee('Test User');
    }

    public function test_admin_can_promote_user()
    {
        $admin = User::factory()->create()->assignRole('superadmin');
        $user = User::factory()->create()->assignRole('user');

        $this->actingAs($admin);

        $response = $this->post("/admin/users/{$user->id}/promote");

        $response->assertRedirect('/admin/users');
        $this->assertTrue($user->fresh()->hasRole('admin'));
    }

    public function test_admin_can_demote_user()
    {
        $admin = User::factory()->create()->assignRole('superadmin');
        $user = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->post("/admin/users/{$user->id}/demote");

        $response->assertRedirect('/admin/users');
        $this->assertTrue($user->fresh()->hasRole('user'));
    }

    public function test_admin_cannot_delete_another_admin()
    {
        $admin = User::factory()->create()->assignRole('superadmin');
        $protectedAdmin = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->delete("/admin/users/{$protectedAdmin->id}");

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error', 'Admins cannot be deleted.');
    }

    public function test_admin_can_delete_user()
    {
        $admin = User::factory()->create()->assignRole('superadmin');
        $user = User::factory()->create()->assignRole('user');

        $this->actingAs($admin);

        $response = $this->delete("/admin/users/{$user->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
