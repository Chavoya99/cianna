<?php

namespace App\Livewire;

use Livewire\Component;

class BotonEnviarMensaje extends Component
{
    
    public function messageSent(){
        $this->dispatch('message');
    }

    public function render()
    {
        return view('livewire.boton-enviar-mensaje');
    }
}
