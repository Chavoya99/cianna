<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    //Mostrar el login
    public function show(){
        return view('auth.login');
    }
}
