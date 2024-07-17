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

        function selecciona_colonia(){
            $colonias = ['Colonia X', 'Colonia Y', 'Colonia Z'];
            return $colonias[array_rand($colonias, 1)];
        }


        foreach($usuarios as $usuario){
            $casa = $usuario->casa()->create(
                [
                    'calle'=> $faker->streetName(),
                    'num_ext' => random_int(1,5000),
                    'codigo_postal' => intval($faker->postcode()),
                    'ciudad' => $faker->city(),
                    'colonia' => selecciona_colonia(),
                    'descripcion' => $faker->text(100),
                    'acepta_mascotas' => genera_si_no(),
                    'acepta_visitas' => genera_si_no(),
                    'riguroza_limpieza' => genera_si_no(),
                    'regla_adicional' => 'Reglas Adicional',
                    'muebles' => genera_si_no(),
                    'servicios' => genera_si_no(),
                    'requisitos' => 'Requisitos',
                    'precio' => random_int(1500, 5000),
                ]
                );
            //Actualizar campo de registro_completo para el usuario relacionado con la casa
            $usuario->update(['registro_completo' => now()]);

            //Imagenes para casas
            $clasificaciones = ['img_cuarto','img_banio','img_sala','img_cocina','img_fachada'];

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

            
        }


    }
}
