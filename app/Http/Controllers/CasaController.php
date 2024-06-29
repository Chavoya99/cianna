<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CasaController extends Controller
{
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Casa $casa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Casa $casa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Casa $casa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Casa $casa)
    {
        //
    }

    public function configuracion_inicial_casa(){
        if(Auth::user()->user_a->registro_completo == null){
            return view('userA.config-hogar');
        }else{
            return redirect(route('homeA'));
        } 
    }

    public function guardar_configuracion_inicial_casa(Request $request){
        $request->validate(
            [
                //Dirección
                'calle' => 'required',
                'num_ext' => 'required|integer|min:1',
                'num_int' => 'nullable|integer|min:1',
                'cod_post' => 'required|integer|min:1',
                'ciudad' => 'required|min:3|max:255',
                'colonia' => 'required|min:3|max:255',

                //Reglas
                'desc' => 'required|min:1|max:300',
                'reglas' => 'nullable|array',
                'reglaXtra' => 'nullable|min:1|max:100',
                'muebles' => 'required',
                'servicios' => 'required',

                //Requisitos-precio-comprobante
                'reqsts' => 'required|min:1|max:300',
                'precio' => 'required|min:1',
                'compDom1' => 'required|mimes:pdf|max:4096',
                'compDom2' => 'required|mimes:pdf|max:4096',

                //Imagenes
                'img_cuarto' => 'required|mimes:jpg,png,jpeg|max:4096',
                'img_banio' => 'required|mimes:jpg,png,jpeg|max:4096',
                'img_sala' => 'required|mimes:jpg,png,jpeg|max:4096',
                'img_cocina' => 'required|mimes:jpg,png,jpeg|max:4096',
                'img_fachada' => 'required|mimes:jpg,png,jpeg|max:4096',
                'img_extra' => 'nullable|mimes:jpg,png,jpeg|max:4096',
            ]

        );
        $num_int = null;
        $regla_extra = 'Sin regla adional';
        if($request->has('num_int')){
            $num_int = $request->num_int;
        }

        if($request->has('reglaXtra')){
            $regla_extra = $request->reglaXtra;
        }

        $reglas = [
            'mascota' => 'n',
            'visita' => 'n',
            'limpieza' => 'n'
        ];

        foreach($request->input('reglas' , []) as $regla){
            $reglas[$regla] = 's';
        }


        Auth::user()->user_a->casa()->create([
            'user_a_id' => Auth::user()->user_a->user_id,
            'calle' => $request->calle,
            'num_ext' => $request->num_ext,
            'num_int' => $num_int,
            'codigo_postal' => $request->cod_post,
            'ciudad' => $request->ciudad,
            'colonia' => $request->colonia,
            'descripcion' => $request->desc,
            'acepta_mascotas' => $reglas['mascota'],
            'acepta_visitas' => $reglas['visita'],
            'riguroza_limpieza' => $reglas['limpieza'],
            'regla_adicional' => $regla_extra,
            'muebles' => $request->muebles,
            'servicios' => $request->servicios,
            'requisitos' => $request->reqsts,
            'precio' => $request->precio,
        ]);

        
        //Registro de imagenes
        $casa = Auth::user()->user_a->casa;
        
        $clasificaciones = ['img_cuarto','img_banio','img_sala','img_cocina','img_fachada'];
        
        for($i=0; $i<5; $i++){

            $imagen = $request->file($clasificaciones[$i]);
            $ubicacion = $imagen->store('archivos_casas', 'public');

            if($request->hasFile($clasificaciones[$i])){
                $casa->archivos()->create([
                    'clasificacion_archivo' => $clasificaciones[$i],
                    'MIME' => $imagen->getClientMimeType(),
                    'ruta_archivo' => $ubicacion
                ]);
            } 
        }

        if($request->hasFile('img_extra')){
            $imagen = $request->file('img_extra');
            $ubicacion = $imagen->store('archivos_casas', 'public');

            $casa->archivos()->create([
                'clasificacion_archivo' => 'img_extra',
                'MIME' => $imagen->getClientMimeType(),
                'ruta_archivo' => $ubicacion
            ]);
        }

        //Registro de comprobantes de domicilio
        if($request->hasFile('compDom1')){
            $imagen = $request->file('compDom1');
            $ubicacion = $imagen->store('archivos_casas', 'public');

            $casa->archivos()->create([
                'clasificacion_archivo' => 'compDom1',
                'MIME' => $imagen->getClientMimeType(),
                'ruta_archivo' => $ubicacion
            ]);
        }

        if($request->hasFile('compDom2')){
            $imagen = $request->file('compDom2');
            $ubicacion = $imagen->store('archivos_casas', 'public');

            $casa->archivos()->create([
                'clasificacion_archivo' => 'compDom2',
                'MIME' => $imagen->getClientMimeType(),
                'ruta_archivo' => $ubicacion
            ]);
        }
        
        Auth::user()->user_a->update(['registro_completo' => now()]);

        return redirect()->route('homeA')->with('success', '¡Registro completado con éxito!');
    
    }
}
