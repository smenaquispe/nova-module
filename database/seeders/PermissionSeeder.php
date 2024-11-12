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
        ];

        foreach ($array_permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
