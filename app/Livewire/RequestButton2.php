<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RequestButton2 extends Component
{
    public $casaId; // ID del elemento a agregar/eliminar de favoritos
    public $isRequested; // Bandera para saber si el elemento ya está en favoritos

    public function mount($casaId)
    {   
        $this->casaId = $casaId;
        $this->isRequested = Auth::user()->user_b->postulaciones()->where('casa_id', $this->casaId)->exists();
    }

    public function postulacion()
    {
        if (!$this->isRequested) {
            Auth::user()->user_b->postulaciones()->attach($this->casaId, ['fecha' => now('America/Belize'), 'estado' => 'pendiente']);
            $this->isRequested = true;
            // Notificación
            toastr()->success('¡Te has postulado exitosamente!', 'Notificación');
        }
    }
    
    public function render()
    {
        return view('livewire.request-button2');
    }
}
