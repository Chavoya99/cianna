<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use DateTime;
use App\Models\UserB;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class PostulacionController extends Controller
{
    public function ver_postulaciones(){
        // Llamar a la API Flask con la API Key en los encabezados
            
            //$apiKey = env('API_KEY');  // Obtener la clave API desde .env
            
            $apiKey = config('app.api_key');
            //dd(config('app.api_key'));

            // Inicializar la variable para evitar el error de variable no definida
            $error_message = null;

        if (Auth::user()->tipo == 'A'){
            $postulaciones_pendientes = Auth::user()->user_a->casa->postulaciones()->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->where('estado', 'pendiente')->orderBy('fecha', 'desc')->get();

            $total_postulaciones = Auth::user()->user_a->casa->postulaciones()->count();

            $carreras = $this->lista_carreras();
            
            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }
            
            $postulaciones = Auth::user()->user_a->casa->postulaciones;
            $id_postulaciones = [];
            foreach($postulaciones as $postulacion){
                $id_postulaciones[] = $postulacion->user_id;
            }

            try {
                $userId = Auth::user()->id; 
                $userType = Auth::user()->tipo;
                
                $response = Http::withHeaders([
                    'Authorization' => "Bearer $apiKey",  // Incluir la API Key en los encabezados
                ])->get(env('API_PYTHON_URL'),[
                    'user_id' => $userId, //Enviamos el id del usuario como parámetro en la URL
                    'user_type' => $userType
                ]);
    
                // Verificar si la respuesta fue exitosa
                if ($response->successful()) {
                    $outcomes = $response->json(); // Obtener los resultados
                    //dd($outcomes);
                } else {
                    // Manejar el caso de error de la API
                    $outcomes = [];
                    $error_message = "Error al recuperar los resultados desde la API. Código de error: " . $response->status();
                }
            } catch (\Illuminate\Http\Client\RequestException $e) {
                // Manejar error de la solicitud HTTP (problemas con la API o la conexión)
                $outcomes = [];
                $error_message = "Hubo un problema al conectarse con la API Flask: " . $e->getMessage();
            } catch (\Exception $e) {
                // Manejar cualquier otro tipo de error inesperado
                $outcomes = [];
                $error_message = "Error inesperado: " . $e->getMessage();
            }

            //return view('profile.requestsA', compact('postulaciones_pendientes', 'total_postulaciones','carreras', 'favoritos'));
            $recomendaciones = UserB::whereIn('user_id', $outcomes)->with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');}])->limit(5)->get();
            
            if(count($recomendaciones) == 0){
                $recomendaciones = UserB::with(['user.archivos' => function ($query) {
                    $query->where('archivo_type', 'img_perf');
                }])->limit(5)->get();
            }
            
            return view('profile.requestsA', compact('postulaciones_pendientes', 'total_postulaciones','carreras', 'recomendaciones', 'outcomes', 'error_message', 'id_postulaciones'));
        }else if(Auth::user()->tipo == 'B'){
            $postulaciones_pendientes = Auth::user()->user_b->postulaciones()->with(['archivos' => function ($query){
                $query->where('clasificacion_archivo', 'img_cuarto');}])->where('estado', 'pendiente')->orderBy('fecha', 'desc')->get();
            
            $total_postulaciones = Auth::user()->user_b->postulaciones()->count();

            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }

            try {
                $userId = Auth::user()->id; 
                $userType = Auth::user()->tipo;
                
                $response = Http::withHeaders([
                    'Authorization' => "Bearer $apiKey",  // Incluir la API Key en los encabezados
                ])->get(env('API_PYTHON_URL'),[
                    'user_id' => $userId, //Enviamos el id del usuario como parámetro en la URL
                    'user_type' => $userType
                ]);
    
                // Verificar si la respuesta fue exitosa
                if ($response->successful()) {
                    $outcomes = $response->json(); // Obtener los resultados
                } else {
                    // Manejar el caso de error de la API
                    $outcomes = [];
                    $error_message = "Error al recuperar los resultados desde la API. Código de error: " . $response->status();
                }
            } catch (\Illuminate\Http\Client\RequestException $e) {
                // Manejar error de la solicitud HTTP (problemas con la API o la conexión)
                $outcomes = [];
                $error_message = "Hubo un problema al conectarse con la API Flask: " . $e->getMessage();
            } catch (\Exception $e) {
                // Manejar cualquier otro tipo de error inesperado
                $outcomes = [];
                $error_message = "Error inesperado: " . $e->getMessage();
            }

            $postulaciones = Auth::user()->user_b->postulaciones;

            $id_postulaciones = [];
            foreach($postulaciones as $postulacion){
                $id_postulaciones[] = $postulacion->id;
            }

            $recomendaciones = Casa::whereIn('id', $outcomes)->with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');}])->limit(5)->get();

            if(count($recomendaciones) == 0){
                $recomendaciones = Casa::with(['archivos' => function ($query) {
                    $query->where('clasificacion_archivo', 'img_cuarto');
                }])->where('user_a_id', '!=', Auth::id())->limit(4)->get();
            }
            return view('profile.requestsB', compact('postulaciones_pendientes', 'total_postulaciones', 'recomendaciones','outcomes', 'error_message', 'id_postulaciones'));
        }
    }

    public function ver_lista_completa_postulaciones(){
        if (Auth::user()->tipo == 'A'){
            
            return view('profile.list-requestsA');
        }else if(Auth::user()->tipo == 'B'){

            return view('profile.list-requestsB');
        }
    }

    public function lista_postulaciones_pendientes(){

        if(Auth::user()->tipo == 'A'){
            return view('profile.list-pending-requestsA');
        
        }else if(Auth::user()->tipo == 'B'){  
            return view('profile.list-pending-requestsB');
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
