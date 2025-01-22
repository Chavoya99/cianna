<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Generator\StringManipulation\Pass\Pass;

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
                'precio' => 'required|min:1|max:30000',
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

        Auth::user()->user_a->casa()->create([
            'user_a_id' => Auth::user()->user_a->user_id,
            'calle' => $request->calle,
            'num_ext' => $request->num_ext,
            'num_int' => $num_int,
            'codigo_postal' => $request->cod_post,
            'ciudad' => $request->ciudad,
            'colonia' => $request->colonia,
            'descripcion' => $request->desc,
            'acepta_mascotas' => ($request->has('reglas') && in_array('mascota', $request->reglas)) ? 'si' : 'no',
            'acepta_visitas' => ($request->has('reglas') && in_array('visita', $request->reglas)) ? 'si' : 'no',
            'riguroza_limpieza' => ($request->has('reglas') && in_array('limpieza', $request->reglas)) ? 'si' : 'no',
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
            $ubicacion = $imagen->store('archivos_casas/img_casas', 'public');

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
            $ubicacion = $imagen->store('archivos_casas/img_casas', 'public');

            $casa->archivos()->create([
                'clasificacion_archivo' => 'img_extra',
                'MIME' => $imagen->getClientMimeType(),
                'ruta_archivo' => $ubicacion
            ]);
        }

        //Registro de comprobantes de domicilio
        if($request->hasFile('compDom1')){
            $imagen = $request->file('compDom1');
            $ubicacion = $imagen->store('archivos_casas/comprobantes_domicilio', 'public');

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
        
        Auth::user()->user_a->update(['registro_completo' => now('America/Belize')]);

        return redirect()->route('homeA')->with('success', '¡Registro completado con éxito!');
    
    }

    public function configurar_casa_guardada(){
        $casa = Auth::user()->user_a->casa;
        $img_cuarto = $casa->archivos()->where('clasificacion_archivo', 'img_cuarto')->first()->ruta_archivo;
        $img_banio = $casa->archivos()->where('clasificacion_archivo', 'img_banio')->first()->ruta_archivo;
        $img_sala =$casa->archivos()->where('clasificacion_archivo', 'img_sala')->first()->ruta_archivo;
        $img_cocina = $casa->archivos()->where('clasificacion_archivo', 'img_cocina')->first()->ruta_archivo;
        $img_fachada =  $casa->archivos()->where('clasificacion_archivo', 'img_fachada')->first()->ruta_archivo;
        $comprobacionImgExtra = $casa->archivos()->where('clasificacion_archivo', 'img_extra')->first();
        $img_extra =  ($comprobacionImgExtra != null) ? $comprobacionImgExtra->ruta_archivo : null;


        //Datos de casa
        $camposCasa = ['calle', 'num_ext', 'num_int', 'codigo_postal', 
        'ciudad', 'colonia', 'descripcion', 'acepta_mascotas', 'acepta_visitas',
        'riguroza_limpieza', 'regla_adicional', 'muebles', 'servicios', 'requisitos', 
        'precio'];
        $datosCasa = [];
        foreach($camposCasa as $campo){
            $datosCasa[$campo] = (old($campo)) ? old($campo) : $casa[$campo];
        }

        return view('profile.room-settings', compact('casa', 'img_cuarto', 'img_banio', 'img_sala', 'img_cocina', 'img_fachada', 'img_extra', 'datosCasa'));
    }

    public function actualizar_informacion_casa(Request $request){
        $request->validate(
            [
                //Dirección
                'calle' => 'required',
                'num_ext' => 'required|integer|min:1',
                'num_int' => 'nullable|integer|min:1',
                'codigo_postal' => 'required|integer|min:1',
                'ciudad' => 'required|min:3|max:255',
                'colonia' => 'required|min:3|max:255',

                //Reglas
                'descripcion' => 'required|min:1|max:300',
                'reglas' => 'nullable|array',
                'regla_adicional' => 'nullable|min:1|max:100',
                'muebles' => 'required',
                'servicios' => 'required',

                //Requisitos-precio-comprobante
                'requisitos' => 'required|min:1|max:300',
                'precio' => 'required|min:1|max:30000',
                'compDom1' => 'mimes:pdf|max:4096',
                'compDom2' => 'mimes:pdf|max:4096',

                //Imagenes
                'img_cuarto' => 'mimes:jpg,png,jpeg|max:4096',
                'img_banio' => 'mimes:jpg,png,jpeg|max:4096',
                'img_sala' => 'mimes:jpg,png,jpeg|max:4096',
                'img_cocina' => 'mimes:jpg,png,jpeg|max:4096',
                'img_fachada' => 'mimes:jpg,png,jpeg|max:4096',
                'img_extra' => 'nullable|mimes:jpg,png,jpeg|max:4096',
            ]

        );

        $casa = Auth::user()->user_a->casa;

        //Imagenes
        foreach($request->files as $clave => $valor){
            if($clave == "img_extra"){
                if(!$casa->archivos()->where('clasificacion_archivo', $clave)->exists()){
                    $ubicacion = $request->file($clave)->store("archivos_casas/img_casas", 'public');
                    $casa->archivos()->create([
                    'clasificacion_archivo' => 'img_extra',
                    'MIME' => $request->file($clave)->getClientMimeType(),
                    'ruta_archivo' => $ubicacion,
                    ]);
                    continue;
                }
            }

            $ubicacion = $request->file($clave)->store("archivos_casas/img_casas", 'public');
            $casa->archivos()->where('clasificacion_archivo', $clave)->update([
                'MIME' => $request->file($clave)->getClientMimeType(),
                'ruta_archivo' => $ubicacion,
            ]);
        }

        //Actualizar registro
        //Datos
        
        $casa->update(
            [
                'calle' => $request->calle,
                'num_ext' => $request->num_ext,
                'num_int' => ($request->num_int != null) ? $request->num_int : null,
                'codigo_postal' => $request->codigo_postal,
                'ciudad' => $request->ciudad,
                'colonia' => $request->colonia,
                'descripcion' => $request->descripcion,
                'acepta_mascotas' => ($request->has('reglas') && in_array('mascota', $request->reglas)) ? 'si' : 'no',
                'acepta_visitas' => ($request->has('reglas') && in_array('visita', $request->reglas)) ? 'si' : 'no',
                'riguroza_limpieza' => ($request->has('reglas') && in_array('limpieza', $request->reglas)) ? 'si' : 'no',
                'regla_adicional' => ($request->regla_adicional != null) ? $request->regla_adicional : null,
                'muebles' => $request->muebles,
                'servicios' => $request->servicios,
                'requisitos' => $request->requisitos,
                'precio' =>$request->precio,
            ]
        );

        return redirect()->route('configurar_casa')->with('success', 'Información de hogar actualizada');

    }
}
