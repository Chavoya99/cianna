<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DateTime;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PostulacionesPendientesB extends Component
{
    //Hay que indicar que se debe usar la librería
    use WithPagination;

    public function render()
    {
        if(Auth::user()->tipo == "B")
        {
            $postulaciones_pendientes = Auth::user()->user_b->postulaciones()->with(['archivos' => 
            function ($query){
                $query->where('clasificacion_archivo', 'img_cuarto');}])->
                        where('estado', 'pendiente')->
                        orderBy('fecha', 'desc')->
                        paginate(10);
            
            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }
            return view('livewire.postulaciones-pendientes-b',  compact('postulaciones_pendientes'));
        }
    }
}
