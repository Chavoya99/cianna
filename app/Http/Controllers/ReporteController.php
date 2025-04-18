<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserA;
use App\Models\UserB;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
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
    public function crear_reporte(Request $request, $autor, $reportado)
    {
        $autor = User::find($autor);
        $reportado = User::find($reportado);

        $autor = ($autor->tipo == "A") ? UserA::find($autor)->first() : UserB::find($autor)->first();
        $reportado = ($reportado->tipo == "A") ? UserA::find($reportado)->first() : UserB::find($reportado)->first();
        

        if(count($autor->reportesEnviados) > 9){
            return redirect()->back()->with('error', 'Has alcanzado el límite de reportes para este usuario, estamos trabajando en ello');
        }

        $reporte = new Reporte([
            'motivo' => $request->motivo,
            'fecha_hora' => now('America/Belize'),
        ]);

        $reporte->autor()->associate($autor);    // puede ser UserA o UserB
        $reporte->reportado()->associate($reportado);    // igual, puede ser A o B

        $reporte->save();

        return redirect()->back()->with('success', "Reporte enviado con éxito");
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
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
