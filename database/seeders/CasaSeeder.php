<?php

namespace Database\Seeders;

use App\Models\UserA;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;

class CasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuarios = UserA::all();
        $faker = Faker::create();
        
        function genera_si_no(){
            $respuestas = ['si', 'no'];
            return $respuestas[array_rand($respuestas, 1)];
        }

        function selecciona_colonia_ciudad(){

            $ciudades = ['gdl', 'zap', 'tlaq', 'tlaj_z', 'ton', 'salto', ];

            $ciudad_colonia[0] = $ciudades[array_rand($ciudades, 1)];

            $colonias = [
                'gdl' => ['5 de Mayo', 'Artesanos', 'Atlas', 'Atemajac del Valle', 
                'Balcones de Oblatos', 'Balcones de Santa María', 'Miravalle',
                'Barragan Hernández', 'Centro', 'Del Fresno', 'Del Sur', 
                'El Sauz', 'Federalismo', 'La Aurora', 'Joyas del Nilo',
                'Las Juntas', 'Mezquitán', 'Mexicaltzingo', 'Jardinez de la Cruz', 'Residencial la Cruz', 'Jardines del Sur'],

                'zap' => ['Agua Fría', 'Balcones de la Cantera', 'Balconaes del Sol', 'Benito Juárez', 'Cristo Rey',
                'Emiliano Zapata', 'Jardinez Tapatíos', 'La Coronilla', 'Miramar', 'Tesistán', 'Santa Lucía'],

                'tlaq' => ['Alborada', 'Alfredo Barba', 'Alamo Lomas', 'Álvaro Obregón', 'Arboledas Sur', 'Camichines', 'Camino Real',
                'Paraíso', 'Palmira', 'Vistas del Cuatro'],

                'tlaj_z' => ['Paseo de los Agaves', 'Patría', 'Punto Sur', 'Real del Bosque', 'Real del Sol', 'Real del Valle'],

                'ton' => ['Real Tonalá', 'Bosques de Tonalá', 'Tonala Centro'],

                'salto' => ['Alameda', 'Baja California', 'Buenavista', 'Buenos Aires', 'Cima Serena', 'El Carmen', 'El Castillo'],
            ];

            $ciudad_colonia[1] = $colonias[$ciudad_colonia[0]][array_rand($colonias[$ciudad_colonia[0]], 1)];
            return $ciudad_colonia;
        }

        function genera_descripcion(){
            $faker = Faker::create();
            $descripcion = sprintf(
                "Habitación %s en un %s. Incluye %s y %s. Ideal para quienes %s, ofrece %s y %s.",
                $faker->randomElement(['amplia', 'cómoda', 'iluminada', 'moderna', 'acogedora']),
                $faker->randomElement(['departamento compartido', 'hogar tranquilo', 'espacio céntrico', 'loft moderno']),
                $faker->randomElement(['ventanas grandes', 'espacio amplio']),
                $faker->randomElement(['transporte cercano', 'ambiente privado']),
                $faker->randomElement(['buscan tranquilidad', 'valoran cercanía a la universidad', 'disfrutan la convivencia']),
                $faker->randomElement(['espacio ideal para estudiantes', 'áreas comunes organizadas']),
                $faker->randomElement(['ubicación conveniente', 'ambiente productivo', 'equilibrio entre estudio y descanso'])
            );

            return $descripcion;
        }


        $numero_de_casa = 1;
        foreach($usuarios as $usuario){
            $colonia_ciudad = selecciona_colonia_ciudad();
            $descripcion = genera_descripcion();
            $casa = $usuario->casa()->create(
                [
                    'calle'=> $faker->streetName(),
                    'num_ext' => random_int(1,5000),
                    'codigo_postal' => intval($faker->postcode()),
                    'ciudad' => $colonia_ciudad[0],
                    'colonia' => $colonia_ciudad[1],
                    'descripcion' => $descripcion,
                    'acepta_mascotas' => genera_si_no(),
                    'acepta_visitas' => genera_si_no(),
                    'riguroza_limpieza' => genera_si_no(),
                    'regla_adicional' => 'Reglas Adicionales',
                    'muebles' => genera_si_no(),
                    'servicios' => genera_si_no(),
                    'requisitos' => 'Requisitos',
                    'precio' => random_int(1500, 5000),
                ]
                );
            //Actualizar campo de registro_completo para el usuario relacionado con la casa
            $usuario->update(['registro_completo' => now('America/Belize')]);

            //Imagenes para casas
            //$clasificaciones = ['img_cuarto','img_banio','img_sala','img_cocina','img_fachada'];


            $rutaImagen = public_path('img/img_prueba_casas/habitaciones/img_cuarto_'.$numero_de_casa.'.jpg');
            if(File::exists($rutaImagen)){
            
                $archivoSimulado = new UploadedFile(
                    $rutaImagen,
                    'image/jpg',
                );
        
                $ubicacion = $archivoSimulado->store('archivos_casas/img_casas', 'public');
                $casa->archivos()->create(
                    [   
                        'clasificacion_archivo' => 'img_cuarto',
                        'MIME' => $archivoSimulado->getClientMimeType(),
                        'ruta_archivo' => $ubicacion,
                    ]
                );
            }else{
                $rutaImagen = public_path('img/img_prueba_casas/img_cuarto.jpg');
                if(File::exists($rutaImagen)){
                
                    $archivoSimulado = new UploadedFile(
                        $rutaImagen,
                        'image/jpg',
                    );
            
                    $ubicacion = $archivoSimulado->store('archivos_casas/img_casas', 'public');
                    $casa->archivos()->create(
                        [   
                            'clasificacion_archivo' => 'img_cuarto',
                            'MIME' => $archivoSimulado->getClientMimeType(),
                            'ruta_archivo' => $ubicacion,
                        ]
                    );
                }
            }

            $clasificaciones = ['img_banio','img_sala','img_cocina','img_fachada'];

            for($i=0; $i<count($clasificaciones); $i++){
                $rutaImagen = public_path('img/img_prueba_casas/'.$clasificaciones[$i].'.jpg');
                if(File::exists($rutaImagen)){
                
                    $archivoSimulado = new UploadedFile(
                        $rutaImagen,
                        'image/jpg',
                    );
            
                    $ubicacion = $archivoSimulado->store('archivos_casas/img_casas', 'public');
                    $casa->archivos()->create(
                        [   
                            'clasificacion_archivo' => $clasificaciones[$i],
                            'MIME' => $archivoSimulado->getClientMimeType(),
                            'ruta_archivo' => $ubicacion,
                        ]
                    );
                }
            }

            


            //Comprobantes de domicilio
            $rutaImagen = public_path('img/comprobantes_prueba/comprobante_domicilio_1.pdf');
            if(File::exists($rutaImagen)){
                
                $archivoSimulado = new UploadedFile(
                    $rutaImagen,
                    'application/pdf',
                );
        
                $ubicacion = $archivoSimulado->store('archivos_casas/comprobantes_domicilio', 'public');
                $casa->archivos()->create(
                    [   
                        'clasificacion_archivo' => 'compDom1',
                        'MIME' => $archivoSimulado->getClientMimeType(),
                        'ruta_archivo' => $ubicacion,
                    ]
                );
            }

            $rutaImagen = public_path('img/comprobantes_prueba/comprobante_domicilio_2.pdf');
            if(File::exists($rutaImagen)){
                
                $archivoSimulado = new UploadedFile(
                    $rutaImagen,
                    'application/pdf',
                );
        
                $ubicacion = $archivoSimulado->store('archivos_casas/comprobantes_domicilio', 'public');
                $casa->archivos()->create(
                    [   
                        'clasificacion_archivo' => 'compDom2',
                        'MIME' => $archivoSimulado->getClientMimeType(),
                        'ruta_archivo' => $ubicacion,
                    ]
                );
            }

            $numero_de_casa++;
        }


    }
}
