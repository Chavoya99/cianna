<?php

namespace Database\Seeders;

use App\Models\Casa;
use App\Models\User;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FavoritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersA = UserA::all();
        $roomies = UserB::limit(4)->get();

        $usersB = UserB::all();
        $casas = Casa::limit(4)->get();
        
        // Asignar 4 roomies aleatorios a cada UserA
        foreach ($usersA as $userA) {

            $roomiesAleatorios = UserB::inRandomOrder()->limit(4)->pluck('user_id');
            

            $userA->favoritos_roomies()->attach($roomiesAleatorios);
        }

        foreach ($usersB as $userB) {

            $casasAleatorias = Casa::inRandomOrder()->limit(4)->pluck('id');
            

            $userB->favoritos_casas()->attach($casasAleatorias);
        }

    }
}
