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

    public function actualizar_cuenta(Request $request){
        $request->validate([
            'desc' => 'required|min:1|max:300',
            'img_perf' => 'nullable|mimes:jpg,png,jpeg|max:4096',
            'mascota' => 'required',
            'edad' => 'required|integer|min:18|max:35',
            'sexo' => 'required',
            'padecimiento' => 'required',
            'codigo' => 'required|regex:/^[a-zA-Z0-9_-]+$/|unique:users_b',
            'lifestyle' => 'required',
            'carrera' => 'required',
            'kardex' => 'nullable|mimes:pdf|max:4096',
        ],[
            'desc.min' => 'Debes dar una descripción de al menos 100 caracteres',
            'img_perf.mimes' => 'Sólo se permiten imagenes .jpg, .png o .jpeg',
            'img_perf.max' => 'La imagen no debe pesar más de 4mb',
        ]);


        $num_mascotas = 0; //Cantidad de mascotas por defecto
        if($request->mascota == 'si'){
            $request->validate([
                'num-mascotas' => 'required|integer|min:1|max:10',
            ],
            [
                'num-mascotas.min' => 'La cantidad de mascotas debe ser mayor a 0',
                'num-mascotas.max' => 'La cantidad de mascotas no debe ser mayor a 10',
            ]);

            $num_mascotas = $request->input('num-mascotas');
            
        }
        
        if($request->input('nom-padecimiento') != null){
            $nom_padecimiento = $request->input('nom-padecimiento');
        }else{
            $nom_padecimiento = 'N/A';  //Si no hay nombre de padecimiento
        }


        if(Auth::user()->tipo == 'A'){
            $user = Auth::user()->user_a;
        }else if( Auth::user()->tipo == 'B'){
            $user = Auth::user()->user_b;
        }

        $user->update([
            'descripcion' => $request->desc,
            'mascota' => $request->mascota,
            'num_mascotas' => $num_mascotas,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'padecimiento' => $request->padecimiento,
            'nom_padecimiento' => $nom_padecimiento,
            'codigo' => $request->codigo,
            'lifestyle' => $request->lifestyle,
            'carrera' => $request->carrera,
        ]);

        if ($request->hasFile('img_perf')) {
            $imagen = $request->file('img_perf');
            $ubicacion = $imagen->store('imagenes_perfil', 'public');

            $user->user->archivos()->where('archivo_type', 'img_perf')->update([
                'archivo_type' => 'img_perf',
                'MIME' => $imagen->getClientMimeType(),
                'ruta_archivo' => $ubicacion,
            ]);
        }

        if ($request->hasFile('kardex')) {
            $kardex = $request->file('kardex');
            $ubicacion = $kardex->store('archivos_kardex', 'public');

            $user->user->archivos()->where('archivo_type', 'kardex')->update([
                'archivo_type' => 'kardex',
                'MIME' => $kardex->getClientMimeType(),
                'ruta_archivo' => $ubicacion,
            ]);
        }

        return redirect()->route('mi_perfil')->with('success', 'Perfil actualizado');
    }
}
