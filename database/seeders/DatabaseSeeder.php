<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'apellido' => 'Dios',
            'email' => 'admin@admin.com',
            'tipo' => 'admin',
            'profile_update' => now(),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'UsuarioA',
            'apellido' => 'A',
            'email' => 'a@gmail.com',
            'tipo' => 'A',
            'profile_update' => now(),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'UsuarioB',
            'apellido' => 'B',
            'email' => 'b@gmail.com',
            'tipo' => 'B',
            'profile_update' => now(),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'pruebaA',
            'apellido' => 'A',
            'email' => 'pruebaA@gmail.com',
            'tipo' => 'A'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'pruebaB',
            'apellido' => 'B',
            'email' => 'pruebaB@gmail.com',
            'tipo' => 'B'
        ]);
    }
}
