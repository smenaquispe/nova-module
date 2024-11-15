<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class NoAdminUserCanViewPermissionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_without_permission_cannot_view_permissions(): void
    {
        $user = User::factory()->create();
        $permission = Permission::create(['name' => 'user access']);

        $user->givePermissionTo($permission);
        $this->travelTo(now()->setTime(15, 0)); // Establece la hora a 15:00 (3:00 PM)

        $response = $this->actingAs($user)
        ->get('/nova/resources/permissions', );

        $response->assertStatus(403);
    }

    public function test_admin_user_can_view_permissions(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'admin access']);

        $role->givePermissionTo($permission);
        $user->assignRole($role);
        
        $response = $this->actingAs($user)
        ->get('/nova/resources/permissions');

        $response->assertStatus(200);
    }
}
