<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoritoRoomieButton extends Component
{   
    public $roomieId; // ID del elemento a agregar/eliminar de favoritos
    public $isFavorited; // Bandera para saber si el elemento ya está en favoritos

    public function mount($roomieId)
    {   
        $this->roomieId = $roomieId;
        $this->isFavorited = Auth::user()->user_a->favoritos_roomies()->where('user_b_id', $this->roomieId)->exists();
    }

    public function favorito()
    {
        if ($this->isFavorited) {
            Auth::user()->user_a->favoritos_roomies()->detach($this->roomieId);
            $this->isFavorited = false;
        } else {
            Auth::user()->user_a->favoritos_roomies()->attach($this->roomieId);
            $this->isFavorited = true;
        }
    }

    public function render()
    {
        return view('livewire.favorito-roomie-button');
    }
}
