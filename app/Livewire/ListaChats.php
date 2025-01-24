<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class ListaChats extends Component
{
    
    public $chats;
    

    public function mount(){
        if(Auth::user()->tipo == "A"){
            $this->chats = Auth::user()->user_a->chats_a()
                ->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->orderBy('fecha_ultimo_mensaje', 'desc')->get();
        }else if(Auth::user()->tipo == "B"){
            $this->chats = Auth::user()->user_b->chats_b()
            ->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->orderBy('fecha_ultimo_mensaje', 'desc')->get();
        }
    }


    #[On('message')]
    public function messageSent(){
        if(Auth::user()->tipo == "A"){
            $this->chats = Auth::user()->user_a->chats_a()
                ->with(['user.archivos' => function ($query) {
                    $query->where('archivo_type', 'img_perf');}])->orderBy('fecha_ultimo_mensaje', 'desc')->get();
        } else if(Auth::user()->tipo == "B") {
            $this->chats = Auth::user()->user_b->chats_b()
                ->with(['user.archivos' => function ($query) {
                    $query->where('archivo_type', 'img_perf');}])->orderBy('fecha_ultimo_mensaje', 'desc')->get();
        }
        $this->render();
    }

    public function render()
    {
        return view('livewire.lista-chats');
    }
}
