<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Casa;
use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Support\Facades\Auth;

class ListadoHabitaciones extends Component
{
    //Hay que indicar que se debe usar la librería
    use WithPagination;

    // Casi el mismo código original
    public function render()
    {
        if(Auth::user()->tipo == 'A'){
            $casas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }])->where('user_a_id', '!=', Auth::id())->paginate(10); //Solo modificamos el get por paginate y se especifica cantidad de registros
        }else if(Auth::user()->tipo == 'B'){
            $casas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }])->paginate(10); //Misma situación que arriba
        }
        
        return view('livewire.listado-habitaciones', compact('casas'));
    }
}
