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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $role = Role::where('name', 'admin')->first();
            $role->givePermissionTo($permission);
        }

        $user_permissions = [
            'view cat',
            'view any cat',
            'update cat',
        ];

        foreach ($user_permissions as $permission) {
            $role = Role::where('name', 'user')->first();
            $role->givePermissionTo($permission);
        }
    }
}
