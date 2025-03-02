<?php

namespace App\Livewire;

use App\Models\Casa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoFiltroHabitaciones extends Component
{
    use WithPagination;
    public $calle;
    public $num_ext;
    public $num_int;
    public $ciudad;
    public $colonia;
    public $cod_post;
    public $mascotas;
    public $visitas;
    public $limpieza;
    public $muebles;
    public $servicios;
    public $minPrice;
    public $maxPrice;

    public function mount(Request $request)
    {
        $this->calle = $request->query('calle', '');
        $this->num_ext = $request->query('num_ext', '');
        $this->num_int = $request->query('num_int', '');
        $this->ciudad = $request->query('ciudad', '');
        $this->colonia = $request->query('colonia', '');
        $this->cod_post = $request->query('cod_post', '');
        $this->mascotas = $request->query('mascotas', '');
        $this->visitas = $request->query('visitas', '');
        $this->limpieza = $request->query('limpieza', '');
        $this->muebles = $request->query('muebles', '');
        $this->servicios = $request->query('servicios', '');
        $this->minPrice = $request->query('minPrice', 0);
        $this->maxPrice = $request->query('maxPrice', 10000);
    }

    public function render()
    {
        if (Auth::user()->tipo == 'A') {
            $casas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }])->where('user_a_id', '!=', Auth::id());
        } else if (Auth::user()->tipo == 'B') {
            $casas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }]);
        }

        if (!empty($this->calle)) {
            $casas = $casas->where('calle', 'like', '%' . $this->calle . '%');
        }

        if (!empty($this->num_ext)) {
            $casas = $casas->where('num_ext', 'like', '%' . $this->num_ext . '%');
        }

        if (!empty($this->num_int)) {
            $casas = $casas->where('num_int', 'like', '%' . $this->num_int . '%');
        }

        if (!empty($this->ciudad)) {
            $casas = $casas->where('ciudad', $this->ciudad);
        }

        if (!empty($this->colonia)) {
            $casas = $casas->where('colonia', 'like', '%' . $this->colonia . '%');
        }

        if (!empty($this->cod_post)) {
            $casas = $casas->where('codigo_postal', 'like', '%' . $this->cod_post . '%');
        }

        if (!empty($this->mascotas)) {
            $casas = $casas->where('acepta_mascotas', $this->mascotas);
        }

        if (!empty($this->visitas)) {
            $casas = $casas->where('acepta_visitas', $this->visitas);
        }

        if (!empty($this->limpieza)) {
            $casas = $casas->where('riguroza_limpieza', $this->limpieza);
        }

        if (!empty($this->muebles)) {
            $casas = $casas->where('muebles', $this->muebles);
        }

        if (!empty($this->servicios)) {
            $casas = $casas->where('servicios', $this->servicios);
        }

        
        $casas = $casas->whereBetween('precio', [$this->minPrice, $this->maxPrice]);
        

        // Imprimir la consulta SQL generada
        //dd($casas->toSql(), $casas->getBindings());
        $casas = $casas->paginate(10);

        return view('livewire.listado-filtro-habitaciones', compact('casas'));
    }
}
