<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    //Mostrar el login
    public function show(){
        return view('auth.login');
    }

    public function redirectTo(){
        if(!Auth::user()->profile_update){
            if(Auth::user()->tipo == 'A'){
                return redirect('/formularioRegistroA');
            }else if(Auth::user()->tipo == 'B'){
                return redirect('/formularioRegistroB');
            }
        }else{
            switch(Auth::user()->tipo){
                case 'admin':
                    return redirect(route('homeAdmin'));
                    break;
                case 'A':
                    return redirect(route('homeA'));
                    break;
                case 'B':
                    return redirect(route('homeB'));
                    break;
            }
        }
    }

    public function configuracion_inicial_perfil(Request $request){

    }
}