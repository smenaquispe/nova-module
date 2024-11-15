<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ScheduleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_cant_access_horario_out_of_range(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'admin access']);

        $role->givePermissionTo($permission);
        $user->assignRole($role);
        
        // $this->travelTo(now());
        
        $response = $this->actingAs($user)
        ->get('/nova/dashboards/main');
        $response->assertStatus(200);
    }

    public function test_user_can_access_horario_in_range(): void
    {
        $user = User::factory()->create();
        $permission = Permission::create(['name' => 'user access']);

        $user->givePermissionTo($permission);
        $this->travelTo(now()->setTime(23, 0)); // Establece la hora a 15:00 (3:00 PM)

        $response = $this->actingAs($user)
        ->get('/nova', );

        $response->assertStatus(302);
    }
}
