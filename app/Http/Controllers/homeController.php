<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function redirectTo(){
        return redirect()->route('home');
    }
    public function show(){
        return view('home', ['texto'=>"Hola mundo"]);
    }
}
