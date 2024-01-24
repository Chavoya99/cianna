<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function show(){
        return view('home', ['texto'=>"Hola mundo"]);
    }
}
