<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        if (User::count() > 0) {
            return;
        }

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin'
        ]);

        $user->assignRole('admin');

        if ($user->wasRecentlyCreated) {
            $this->command->info("Usuario '{$user->name}' creado exitosamente.");
        } else {
            $this->command->info("El usuario con email '{$user->email}' ya existe.");
        }
    }
}
