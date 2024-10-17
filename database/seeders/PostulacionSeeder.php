<?php

namespace Database\Seeders;

use App\Models\Casa;
use App\Models\UserB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = UserB::first();
        $casas = Casa::limit(4)->get();

        foreach($casas as $casa){
            $user->postulaciones()->attach($casa->id, ['fecha' => now('America/Belize')]);
        }
    }
}
