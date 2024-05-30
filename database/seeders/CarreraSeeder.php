<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carreras = [
            'Ing. en Alimentos y Biotecnología',
            'Ing. Biomédica',
            'Ing. Civil',
            'Ing. en Computación',
            'Ing. en Comunicaciones y Eléctrónica',
            'Ing. en Logística y Transporte',
            'Ing. en Topografía Geomática',
            'Ing. Fotónica',
            'Ing. Industrial',
            'Ing. Informática',
            'Ing. Mecánica Eléctrica',
            'Ing. Química',
            'Ing. Robótica',
            'Lic. en Ciencia de Materiales',
            'Lic. en Física',
            'Lic. en Matemáticas',
            'Lic. en Química',
            'Lic. Químico Farmaceútico Biólogo'
        ];

        foreach($carreras as $carrera){
            Carrera::create([
                'nombre' => $carrera
            ]);
        }
        
    }
}
