<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_permissions = [
            'force delete cat',
            'restore cat',
            'delete cat',
            'update cat',
            'create cat',
            'view cat',
            'view any cat',
            'make csv cat',
            'make csv user',
        ];

        foreach ($array_permissions as $permission) {
            if (Permission::where('name', $permission)->exists()) {
                continue;
            }
            Permission::create(['name' => $permission]);
        }
    }
}
