<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{   
    public $casaId; // ID del elemento a agregar/eliminar de favoritos
    public $isFavorited; // Bandera para saber si el elemento ya está en favoritos

    public function mount($casaId)
    {   
        $this->casaId = $casaId;
        $this->isFavorited = Auth::user()->user_b->favoritos_casas()->where('casa_id', $this->casaId)->exists();
    }

    public function favorito()
    {
        if ($this->isFavorited) {
            Auth::user()->user_b->favoritos_casas()->detach($this->casaId);
            $this->isFavorited = false;
            // Notificación
            toastr()->success('¡Habitación eliminada de tus favoritos exitosamente!', 'Notificación');
        } else {
            Auth::user()->user_b->favoritos_casas()->attach($this->casaId);
            $this->isFavorited = true;
            // Notificación
            toastr()->success('¡Agregaste la habitación a tus favoritos exitosamente!', 'Notificación');
        }
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}
