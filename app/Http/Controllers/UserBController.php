<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserBController extends Controller
{
    public function homeB()
    {

        $postulaciones = Auth::user()->user_b->postulaciones;

        $id_postulaciones_casas = []; //Casas que estan en las postulaciones del usuario
        $id_postulaciones_roomies = []; //Roomies a los que pertenece la casa
        foreach ($postulaciones as $postulacion) {
            $id_postulaciones_casas[] = $postulacion->id;
            $id_postulaciones_roomies[] = $postulacion->user_a->user_id;
        }

        $outcomes = $this->obtener_recomendaciones();

        $casas = Casa::whereIn('id', $outcomes)->with(['archivos' => function ($query) {
            $query->where('clasificacion_archivo', 'img_cuarto');
        }])->limit(4)->get();


        $id_recomendados = [];
        foreach ($outcomes as $outcome) {
            $casa = Casa::find($outcome);
            $id_recomendados[] = $casa->user_a->user_id;
        }

        $roomies = UserA::whereIn('user_id', $id_recomendados)->with(['user.archivos' => function ($query) {
            $query->where('archivo_type', 'img_perf');
        }])->limit(5)->get();

        if(count($casas) == 0){
            $casas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }])->where('user_a_id', '!=', Auth::id())->limit(4)->get();
        }

        if(count($roomies) == 0){
            $roomies = UserA::with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');
            }])->limit(5)->get();
        }

        return view('profile.home', compact('casas', 'roomies', 'id_postulaciones_casas', 'id_postulaciones_roomies'));
    }


    public function recomendaciones_b_roomies()
    {
        return view('profile.list-suggestsA');
    }

    public function recomendaciones_b_casas()
    {
        return view('profile.list-suggestsB');
    }

    public function obtener_recomendaciones()
    {
        $apiKey = config('app.api_key');

        // Inicializar la variable para evitar el error de variable no definida
        $error_message = null;

        try {
            $userId = Auth::user()->id;
            $userType = Auth::user()->tipo;

            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",  // Incluir la API Key en los encabezados
            ])->get(env('API_PYTHON_URL'), [
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

        return $outcomes;
    }
}
