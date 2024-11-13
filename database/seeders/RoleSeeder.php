<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        
        if (!Role::where('name', 'user')->exists()) {
            Role::create(['name' => 'user']);
        }

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role = Role::where('name', 'admin')->first();
            if ($role->hasPermissionTo($permission)) {
                continue;
            }
            $role->givePermissionTo($permission);
        }

        $user_permissions = [
            'view cat',
            'view any cat',
            'update cat',
        ];

        foreach ($user_permissions as $permission) {
            $role = Role::where('name', 'user')->first();
            if ($role->hasPermissionTo($permission)) {
                continue;
            }
            $role->givePermissionTo($permission);
        }
    }
}
