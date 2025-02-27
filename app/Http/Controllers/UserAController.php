<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserAController extends Controller
{   
    public function homeA(){
        if(!Auth::user()->user_a->registro_completo){
            return redirect(route('config_hogar'));
        }
        $casas = Casa::with(['archivos' => function ($query) {
            $query->where('clasificacion_archivo', 'img_cuarto');
        }])->where('user_a_id', '!=', Auth::id())->limit(4)->get();

        $postulaciones = Auth::user()->user_a->casa->postulaciones;
        $id_postulaciones = [];
        foreach($postulaciones as $postulacion){
            $id_postulaciones[] = $postulacion->user_id;
        }

        $outcomes = $this->obtener_recomendaciones();
        $roomies = UserB::whereIn('user_id', $outcomes)->with(['user.archivos' => function ($query) {
            $query->where('archivo_type', 'img_perf');}])->limit(6)->get();
        
        return view('profile.home', compact('casas','roomies', 'id_postulaciones'));
    }

    public function recomendaciones_A(){
        function lista_carreras(){
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

        $carreras = lista_carreras();
        $postulaciones = Auth::user()->user_a->casa->postulaciones;
        $id_postulaciones = [];
        foreach($postulaciones as $postulacion){
            $id_postulaciones[] = $postulacion->user_id;
        }
        
        $outcomes = $this->obtener_recomendaciones();

        $recomendaciones = UserB::whereIn('user_id', $outcomes)->with(['user.archivos' => function ($query) {
            $query->where('archivo_type', 'img_perf');}])->limit(5)->get();
    
        return view('profile.list-suggestsA' ,compact('recomendaciones', 'carreras', 'id_postulaciones'));
    }

    public function obtener_recomendaciones(){
        $apiKey = config('app.api_key');

        // Inicializar la variable para evitar el error de variable no definida
        $error_message = null;
        
    
        try {
            $userId = Auth::user()->id; 
            $userType = Auth::user()->tipo;
            
            $response = Http::withHeaders([
                'Authorization' => "Bearer $apiKey",  // Incluir la API Key en los encabezados
            ])->get('http://127.0.0.1:5000/recommendations',[
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserA $userA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserA $userA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserA $userA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserA $userA)
    {
        //
    }
}
