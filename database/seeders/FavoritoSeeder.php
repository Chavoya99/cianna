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
        $userA = UserA::first();
        $roomies = UserB::limit(4)->get();

        $userB = UserB::first();
        $casas = Casa::limit(4)->get();
        
        foreach($roomies as $roomie){
            $userA->favoritos_roomies()->attach($roomie->user_id);
        }

        foreach($casas as $casa){
            $userB->favoritos_casas()->attach($casa->id);
        }
        


    }
}
