<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginRegisterController extends Controller
{
    //Mostrar el login
    public function show(){
        return view('auth.login');
    }

    public function redirectTo(){
        if(!Auth::user()->profile_update){
            return redirect(route('ver_configuracion_inicial_cuenta'));
        }else{
            switch(Auth::user()->tipo){
                case 'admin':
                    return redirect(route('homeAdmin'));
                    break;
                case 'A':
                    if(Auth::user()->user_a->registro_completo){
                        return redirect(route('homeA'));
                    }
                    else{
                        return redirect(route('config_hogar'));
                    }
                    
                    break;
                case 'B':
                    return redirect(route('homeB'));
                    break;
            }
        }
    }

    public function ver_configuracion_inicial_cuenta(Request $request){
        return view('profile.configuracion_inicial_cuenta');
    }

    public function guardar_configuracion_inicial_cuenta(Request $request){
        
        $request->validate([
            'desc' => 'required|min:1|max:300',
            'img_perf' => 'required|mimes:jpg,png,jpeg|max:4096',
            'mascota' => 'required',
            'edad' => 'required|integer|min:18|max:35',
            'sexo' => 'required',
            'padecimiento' => 'required',
            'lifestyle' => 'required',
            'carrera' => 'required',
            'kardex' => 'required|mimes:pdf|max:4096',
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
            $request->validate(['codigo' => 'required|regex:/^[a-zA-Z0-9_-]+$/|unique:users_a']);
            $user = UserA::create([
                'user_id' => Auth::id(),
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

            $ruta = 'config_hogar';

        }else if(Auth::user()->tipo == 'B'){
            $request->validate(['codigo' => 'required|regex:/^[a-zA-Z0-9_-]+$/|unique:users_b']);
            $user = UserB::create([
                'user_id' => Auth::id(),
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

            $ruta = 'homeB';


        }

        $user = User::find(Auth::id());
        if ($user) {
            if ($request->hasFile('img_perf')) {
                $imagen = $request->file('img_perf');
                $ubicacion = $imagen->store('imagenes_perfil', 'public');

                $user->archivos()->create([
                    'archivo_type' => 'img_perf',
                    'MIME' => $imagen->getClientMimeType(),
                    'ruta_archivo' => $ubicacion,
                ]);
            } else {
                // Maneja el caso donde no hay archivo cargado
                return back()->withErrors(['img_perf' => 'No se ha cargado ningún archivo.']);
            }

            if ($request->hasFile('kardex')) {
                $kardex = $request->file('kardex');
                $ubicacion = $kardex->store('archivos_kardex', 'public');

                $user->archivos()->create([
                    'archivo_type' => 'kardex',
                    'MIME' => $kardex->getClientMimeType(),
                    'ruta_archivo' => $ubicacion,
                ]);
            } else {
                // Maneja el caso donde no hay archivo cargado
                return back()->withErrors(['kardex' => 'No se ha cargado ningún archivo.']);
            }
        } else {
            // Maneja el caso donde no hay usuario autenticado
            return back()->withErrors(['user' => 'El usuario no está autenticado.']);
        }

        $user->update(['profile_update' => now('America/Belize')]);

        return redirect()->route($ruta)->with('success', 'Configuración de cuenta terminada');

        
        
        
    }
}