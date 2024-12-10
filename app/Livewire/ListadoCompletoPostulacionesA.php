<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DateTime;
use App\Models\Postulacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class ListadoCompletoPostulacionesA extends Component
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
        if(Auth::user()->tipo == "A")
        {
            $postulaciones = Auth::user()->user_a->casa->postulaciones()->with(['user.archivos' => function ($query){
                $query->where('archivo_type', 'img_perf');}])->orderByRaw("CASE WHEN estado = 'pendiente' THEN 1
                WHEN estado = 'aceptada' THEN 2
                WHEN estado = 'rechazada' THEN 3 END")->orderBy('fecha', 'desc')->paginate(10);
            $carreras = $this->lista_carreras();

            if(count($postulaciones) == 0){
                return redirect(route('ver_postulaciones'));
            }
            
            foreach($postulaciones as $postulacion){
                $postulacion->pivot->fecha = new DateTime($postulacion->pivot->fecha);              
            }
        }
        return view('livewire.listado-completo-postulaciones-a', compact('postulaciones','carreras'));
    }
}
