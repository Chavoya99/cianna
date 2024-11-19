<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ListadoFavoritosA extends Component
{
    //Hay que indicar que se debe usar la librería
    use WithPagination;
    
    // Hay que agregar la función para que reconozca las carreras
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

    // Casi el mismo código original
    public function render()
    {
        if (Auth::user()->tipo == 'A'){
            $favoritos = Auth::user()->user_a->favoritos_roomies()->with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');}])->paginate(10);
            
            $carreras = $this->lista_carreras();

            return view('livewire.listado-favoritos-a', compact('favoritos', 'carreras'));
        }
    }
}
