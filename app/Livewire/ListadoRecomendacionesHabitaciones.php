<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Casa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ListadoRecomendacionesHabitaciones extends Component
{
    use WithPagination;

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

    public function render()
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
        }])->paginate(10);

        return view('livewire.listado-recomendaciones-habitaciones', compact('casas', 'id_postulaciones_casas'));
    }
}
