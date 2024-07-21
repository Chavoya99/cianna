<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function redirectTo(){
        return redirect()->route('home');
    }
    public function show(){
        return view('home', ['texto'=>"Hola mundo"]);
    }

    public function home_invitado(){
        $casas = Casa::limit(4)->get();
        $userA = UserA::limit(3)->get();
        $userB = UserB::limit(3)->get();
        $roomies = $userA->concat($userB);
        return view('profile.home', compact('casas', 'roomies'));
    }
}
