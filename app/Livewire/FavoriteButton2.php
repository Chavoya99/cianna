<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriteButton2 extends Component
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
            Auth::user()->user_b->favorites()->detach($this->itemId);
            $this->isFavorited = false;
        } else {
            Auth::user()->user_b->favorites()->attach($this->itemId);
            $this->isFavorited = true;
        }
    }

    public function render()
    {
        return view('livewire.favorite-button2');
    }
}
