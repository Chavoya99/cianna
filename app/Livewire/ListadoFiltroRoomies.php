<?php

namespace App\Livewire;

use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListadoFiltroRoomies extends Component
{
    use WithPagination;
    public $edad_min;
    public $edad_max;
    public $sexo;
    public $carreras = [];
    public $mascota;
    public $padecimiento;
    public $lifestyle = [];

    public function lista_carreras()
    {
        return [
            'ing_alim_biot' => 'Ing. en Alimentos y Biotecnología',
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
            'lic_qfb' => 'Lic. en Químico Farmacéutico Biólogo',
        ];
    }

    public function mount(Request $request)
    {
        $this->edad_min = $request->query('edad_min', 18);
        $this->edad_max = $request->query('edad_max', 35);
        $this->sexo = $request->query('sexo', '');
        $this->carreras = $request->query('carreras', []);
        $this->mascota = $request->query('mascota', '');
        $this->padecimiento = $request->query('padecimiento', '');
        $this->lifestyle = $request->query('lifestyle', []);
    }

    public function render()
    {
        $users = Auth::user()->tipo == 'A'
            ? UserB::with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');
            }])
            : UserA::with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');
            }]);

        // Aplicar filtros de edad
        $users = $users->whereBetween('edad', [$this->edad_min, $this->edad_max]);

        // Filtro de sexo
        if (!empty($this->sexo)) {
            $users = $users->where('sexo', $this->sexo);
        }

        // Filtro de carrera: Solo aplicar si hay elementos en $this->carreras
        if (!empty($this->carreras) && is_array($this->carreras)) {
            // Limpiar los valores nulos de $this->carreras
            $this->carreras = array_filter($this->carreras, function ($value) {
                return !is_null($value);
            });

            // Aplicar el filtro de carrera solo si el array no está vacío
            if (!empty($this->carreras)) {
                $users = $users->whereIn('carrera', $this->carreras);
            }
        }

        // Filtro de mascota
        if (!empty($this->mascota)) {
            $users = $users->where('mascota', $this->mascota);
        }

        // Filtro de padecimiento
        if (!empty($this->padecimiento)) {
            $users = $users->where('padecimiento', $this->padecimiento);
        }

        // Filtro de lifestyle: Solo aplicar si hay elementos en $this->lifestyle
        if (!empty($this->lifestyle) && is_array($this->lifestyle)) {
            // Limpiar los valores nulos de $this->lifestyle
            $this->lifestyle = array_filter($this->lifestyle, function ($value) {
                return !is_null($value);
            });

            // Aplicar el filtro de lifestyle solo si el array no está vacío
            if (!empty($this->lifestyle)) {
                $users = $users->whereIn('lifestyle', $this->lifestyle);
            }
        }

        // Imprimir la consulta SQL generada
        //dd($users->toSql(), $users->getBindings());
        $users = $users->paginate(10);

        return view('livewire.listado-filtro-roomies', [
            'users' => $users,
            'careers' => $this->lista_carreras()
        ]);
    }
}
