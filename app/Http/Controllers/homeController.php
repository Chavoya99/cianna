<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function configuracion_cuenta(){
        if(Auth::user()->tipo == 'A'){
            $usuario = Auth::user()->user_a;
        }else if(Auth::user()->tipo == 'B')
        {
            $usuario = Auth::user()->user_b;
        }else{
            $usuario = Auth::user();
        }

        return view('profile.account-settings', compact('usuario'));
    }

    public function ver_perfil_usuario(){
        if(Auth::user()->tipo == 'A'){
            $usuario = Auth::user()->user_a;
        }else if(Auth::user()->tipo == 'B')
        {
            $usuario = Auth::user()->user_b;
        }else{
            $usuario = Auth::user();
        }
        $carreras = ['ing_alim_biot' => 'Ing. en Alimentos y Biotecnología',
        'ing_biom' => 'Ing. Biómedica',
        'ing_civi' => 'Ing. Civil',
        'ing_comp' => 'Ing. Computación',
        'ing_com_elec' => 'Ing. en Comunicaciones y Eléctrónica',
        'ing_log_trans' => 'Ing. en Logística y Transporte',
        'ing_topo' => 'Ing. en Topografía Geomática',
        'ing_foto' => 'Ing. Fotónica',
        'ing_indu' => 'Ing. Industrial',
        'ing_info' => 'Ing. Informática',
        'ing_meca' => 'Ing. Mecánica Eléctrica',
        'ing_quim' => 'Ing. Química',
        'ing_robo' => 'Ing. Robótica',
        'lic_cien_mate' => 'Lic. en Ciencia de Materiales',
        'lic_fis' => 'Lic. en Física',
        'lic_mate' => 'Lic. en Matemáticas',
        'lic_quim' => 'Lic. en Química',
        'lic_qfb' => 'Lic. en Químico Farmacéutico Biólogo'];

        $img_perfil = Auth::user()->archivos()->where('archivo_type', 'img_perf')->first();

        return view('profile.my-profile', ['usuario'=>$usuario, 'img_perfil' => $img_perfil, 'carrera' => $carreras[$usuario->carrera]]);
    }
}
