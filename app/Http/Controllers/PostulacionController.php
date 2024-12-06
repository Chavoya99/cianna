<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PostulacionController extends Controller
{
    public function ver_postulaciones(){
        if (Auth::user()->tipo == 'A'){
            $postulaciones_pendientes = Auth::user()->user_a->casa->postulaciones()->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->where('estado', 'pendiente')->orderBy('fecha', 'desc')->get();

            $total_postulaciones = Auth::user()->user_a->casa->postulaciones()->count();

            $carreras = $this->lista_carreras();
            
            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }

            return view('profile.requestsA', compact('postulaciones_pendientes', 'total_postulaciones','carreras'));
        }else if(Auth::user()->tipo == 'B'){
            $postulaciones_pendientes = Auth::user()->user_b->postulaciones()->with(['archivos' => function ($query){
                $query->where('clasificacion_archivo', 'img_cuarto');}])->where('estado', 'pendiente')->orderBy('fecha', 'desc')->get();
            
            $total_postulaciones = Auth::user()->user_b->postulaciones()->count();

            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }

            return view('profile.requestsB', compact('postulaciones_pendientes', 'total_postulaciones'));
        }
    }

    public function ver_lista_completa_postulaciones(){
        if (Auth::user()->tipo == 'A'){
            $postulaciones = Auth::user()->user_a->casa->postulaciones()->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->orderByRaw("CASE WHEN estado = 'pendiente' THEN 1
              WHEN estado = 'aceptada' THEN 2
              WHEN estado = 'rechazada' THEN 3 END")->orderBy('fecha', 'desc')->get();
            $carreras = $this->lista_carreras();

            if(count($postulaciones) == 0){
                return redirect(route('ver_postulaciones'));
            }
            
            foreach($postulaciones as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }

            return view('profile.list-requestsA', compact('postulaciones','carreras'));

        }else if(Auth::user()->tipo == 'B'){
            $postulaciones = Auth::user()->user_b->postulaciones()->with(['archivos' => function ($query){
                $query->where('clasificacion_archivo', 'img_cuarto');}])->orderByRaw("CASE WHEN estado = 'pendiente' THEN 1
                WHEN estado = 'aceptada' THEN 2
                WHEN estado = 'rechazada' THEN 3 END")->orderBy('fecha', 'desc')->get();
            
            if(count($postulaciones) == 0){
                return redirect(route('ver_postulaciones'));
            }
            
            foreach($postulaciones as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }

            return view('profile.list-requestsB', compact('postulaciones'));
        }

        
    }

    public function lista_postulaciones_pendientes(){

        if(Auth::user()->tipo == 'A'){
            $postulaciones_pendientes = Auth::user()->user_a->casa->postulaciones()->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->where('estado', 'pendiente')->orderBy('fecha', 'desc')->get();

            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }
            $carreras = $this->lista_carreras();

            return view('profile.list-pending-requestsA', compact('postulaciones_pendientes', 'carreras'));
        
        }else if(Auth::user()->tipo == 'B'){  
            $postulaciones_pendientes = Auth::user()->user_b->postulaciones()->with(['archivos' => function ($query){
                $query->where('clasificacion_archivo', 'img_cuarto');}])->where('estado', 'pendiente')->orderBy('fecha', 'desc')->get();
            
            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }
            return view('profile.list-pending-requestsB', compact('postulaciones_pendientes'));

        }
    }

    public function aceptar_postulacion($postulacion)
    {
        // Se recibe el id del user_b que hizo la postulacion
        Auth::user()->user_a->casa->postulaciones()->where('user_b_id', $postulacion)->update(['estado' => 'aceptada']);

        // Crear el chat directamente en este controlador
        $users_id = [Auth::id(), intval($postulacion)];
        rsort($users_id);

        $roomId = $users_id[0]."_".$users_id[1];
        
        $request = new Request([
            'user_1_id' => Auth::id(),
            'user_2_id' => $postulacion,
            'room_id' => $roomId
        ]);

        return app(ChatController::class)->crear_chat($request);
    }

    public function obtener_nombre_carrera($llave){
        $carreras = $this->lista_carreras();
        return $carreras[$llave];
    }

    public function lista_carreras(){
        $carreras = ['ing_alim_biot' => 'Ing. en Alimentos y Biotecnología',
        'ing_biom' => 'Ing. Biómedica',
        'ing_civi' => 'Ing. Civil',
        'ing_comp' => 'Ing. en Computación',
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

        return $carreras;
    }
}
