<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Livewire\Component;

class ListadoRecomendacionesRoomies extends Component
{
    use WithPagination;

    function lista_carreras()
    {
        $carreras = [
            'ing_alim_biot' => 'Ing. en Alimentos y Biotecnología',
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
            'lic_qfb' => 'Lic. en Químico Farmacéutico Biólogo'
        ];

        return $carreras;
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

    public function render()
    {
        $carreras = $this->lista_carreras();
        if (Auth::user()->tipo == 'A') {
            $postulaciones = Auth::user()->user_a->casa->postulaciones;
            $id_postulaciones = [];
            foreach ($postulaciones as $postulacion) {
                $id_postulaciones[] = $postulacion->user_id;
            }

            $outcomes = $this->obtener_recomendaciones();

            $recomendaciones = UserB::whereIn('user_id', $outcomes)->with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');
            }])->paginate(10);

            return view('livewire.listado-recomendaciones-roomies', compact('recomendaciones', 'carreras', 'id_postulaciones'));
        } elseif (Auth::user()->tipo == 'B') {
            $postulaciones = Auth::user()->user_b->postulaciones;

            $id_postulaciones_roomies = []; //Roomies a los que pertenece la casa
            foreach ($postulaciones as $postulacion) {
                $id_postulaciones_roomies[] = $postulacion->user_a->user_id;
            }

            $outcomes = $this->obtener_recomendaciones();

            $id_recomendados = [];
            foreach ($outcomes as $outcome) {
                $casa = Casa::find($outcome);
                $id_recomendados[] = $casa->user_a->user_id;
            }

            $recomendaciones = UserA::whereIn('user_id', $id_recomendados)->with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');
            }])->paginate(10);

            return view('livewire.listado-recomendaciones-roomies', compact('recomendaciones', 'carreras', 'id_postulaciones_roomies'));
        }
    }
}
