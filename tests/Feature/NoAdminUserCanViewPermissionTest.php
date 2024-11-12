<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class NoAdminUserCanViewPermissionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_without_permission_cannot_view_permissions(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->get('/nova/resources/permissions', );

        $response->assertStatus(403);
    }

    public function test_admin_user_can_view_permissions(): void
    {
        $user = User::factory()->create();
        Role::create(['name' => 'admin']);
        $user->assignRole('admin');

        $response = $this->actingAs($user)
        ->get('/nova/resources/permissions');

        $response->assertStatus(200);
    }
}
