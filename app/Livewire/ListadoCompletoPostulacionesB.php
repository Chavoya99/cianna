<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DateTime;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ListadoCompletoPostulacionesB extends Component
{
    //Hay que indicar que se debe usar la librería
    use WithPagination;

    public function render()
    {
        if(Auth::user()->tipo == "B")
        {
            $postulaciones = Auth::user()->user_b->postulaciones()->with(['archivos' => function ($query){
                $query->where('clasificacion_archivo', 'img_cuarto');}])->orderByRaw("CASE WHEN estado = 'pendiente' THEN 1
                WHEN estado = 'aceptada' THEN 2
                WHEN estado = 'rechazada' THEN 3 END")->orderBy('fecha', 'desc')->paginate(10);
            
            if(count($postulaciones) == 0){
                return redirect(route('ver_postulaciones'));
            }
            
            foreach($postulaciones as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }

            return view('livewire.listado-completo-postulaciones-b', compact('postulaciones'));
        }
    }
}
