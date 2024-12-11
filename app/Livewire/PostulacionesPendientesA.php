<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DateTime;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PostulacionesPendientesA extends Component
{
    //Hay que indicar que se debe usar la librería
    use WithPagination;

    public function lista_carreras(){
        $carreras = ['ing_alim_biot' => 'Ing. en Alimentos y Biotecnología',
        'ing_biom' => 'Ing. Biómedica',
        'ing_civi' => 'Ing. Civil',
        'ing_comp' => 'Ing. en Computación',
        'ing_com_elec' => 'Ing. en Comunicaciones y Eléctrónica',
        'ing_log_trans' => 'Ing. en Logística y Transporte',
        'ing_topo' => 'Ing. en Topografía Geomática',
        'ing_foto' => 'Ing. Fotónica',
        'ing_indu' => 'Ing. Industrial',
        'ing_info' => 'Ing. Informática',
        'ing_meca' => 'Ing. Mecánica Eléctrica',
        'ing_quim' => 'Ing. Química',
        'ing_robo' => 'Ing. Robótica',
        'lic_cien_mate' => 'Lic. en Ciencia de Materiales',
        'lic_fis' => 'Lic. en Física',
        'lic_mate' => 'Lic. en Matemáticas',
        'lic_quim' => 'Lic. en Química',
        'lic_qfb' => 'Lic. en Químico Farmacéutico Biólogo'];

        return $carreras;
    }
    
    public function render()
    {
        if(Auth::user()->tipo == 'A'){
            $postulaciones_pendientes = Auth::user()->user_a->casa->postulaciones()->
                with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->
                        where('estado', 'pendiente')->
                        orderBy('fecha', 'desc')->
                        paginate(10);

            foreach($postulaciones_pendientes as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }
            $carreras = $this->lista_carreras();

            return view('livewire.postulaciones-pendientes-a', compact('postulaciones_pendientes', 'carreras'));
        
        }
    }
}
