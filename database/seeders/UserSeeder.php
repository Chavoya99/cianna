<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserA;
use App\Models\UserB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'apellido' => 'Dios',
            'email' => 'admin@admin.com',
            'tipo' => 'admin',
            'profile_update' => now('America/Belize'),
        ]);

        User::factory()->create([
            'name' => 'pruebaA',
            'apellido' => 'A',
            'email' => 'pruebaA@gmail.com',
            'tipo' => 'A'
        ]);

        User::factory()->create([
            'name' => 'pruebaB',
            'apellido' => 'B',
            'email' => 'pruebaB@gmail.com',
            'tipo' => 'B'
        ]);


        $sexo = ['Masculino', 'Femenino'];
        $mascota = ['si','no'];
        $padecimiento = ['si', 'no'];
        $lifestyle = ['d','t','a'];
        $carrera = ['ing_comp', 'ing_info', 'ing_civi', 'ing_robo'];
    

        $faker = Faker::create();

        function seleccionarPadecimiento(){
            $opc_padecimiento = ['si', 'no'];
            $nom_padecimiento = ['Asma', 'Gripe', 'Diabetes'];
            $padecimiento = [];
            $padecimiento[0] = $opc_padecimiento[array_rand($opc_padecimiento,1)];

            if($padecimiento[0] == 'si'){
                $padecimiento[1] = $nom_padecimiento[array_rand($nom_padecimiento,1)];
            }else{
                $padecimiento[1] = "N/A";
            }
            return $padecimiento;
        }
        function generarUsuario($faker,$tipo,$sexo,$mascota,$padecimiento,$lifestyle,$carrera){
            $padecimiento = seleccionarPadecimiento();

            $user = User::factory()->create([
                'profile_update' => now('America/Belize'),
                'tipo' => $tipo,
            ]);

            if($tipo == 'A'){
                $user->user_a()->create([
                    'edad' => random_int(18,35),
                    'sexo' => $sexo[array_rand($sexo, 1)],
                    'descripcion' => $faker->text(100),
                    'mascota' => $mascota[array_rand($mascota, 1)],
                    'num_mascotas' => random_int(1, 5),
                    'padecimiento' => $padecimiento[0],
                    'nom_padecimiento' => $padecimiento[1],
                    'lifestyle' => $lifestyle[array_rand($lifestyle, 1)],
                    'carrera' => $carrera[array_rand($carrera,1)],
                    'codigo' => $faker->regexify('[1-9][0-9]{8}'),
                ]);

            }else{
                $user->user_b()->create([
                    'edad' => random_int(18,35),
                    'sexo' => $sexo[array_rand($sexo, 1)],
                    'descripcion' => $faker->text(100),
                    'mascota' => $mascota[array_rand($mascota, 1)],
                    'num_mascotas' => random_int(1, 5),
                    'padecimiento' => $padecimiento[0],
                    'nom_padecimiento' => $padecimiento[1],
                    'lifestyle' => $lifestyle[array_rand($lifestyle, 1)],
                    'carrera' => $carrera[array_rand($carrera,1)],
                    'codigo' => $faker->regexify('[1-9][0-9]{8}'),
                ]);
            }
            

            if($user->tipo == 'A'){
                if($user->user_a->sexo == 'Masculino'){
                    $user->update(['name' => $faker->firstNameMale]);
                    $rutaImagen = public_path('img/masculino.jpg');
                }else{
                    $user->update(['name' => $faker->firstNameFemale]);
                    $rutaImagen = public_path('img/femenino.jpg');
                } 
            }else{
                if($user->user_b->sexo == 'Masculino'){
                    $user->update(['name' => $faker->firstNameMale]);
                    $rutaImagen = public_path('img/masculino.jpg');
                }else{
                    $user->update(['name' => $faker->firstNameFemale]);
                    $rutaImagen = public_path('img/femenino.jpg');
                } 
            }   

            if(File::exists($rutaImagen)){
                
                $archivoSimulado = new UploadedFile(
                    $rutaImagen,
                    'image/jpg',
                );
        
                $ubicacion = $archivoSimulado->store('imagenes_perfil', 'public');
                $user->archivos()->create(
                    [   
                        'archivo_type' => 'img_perf',
                        'MIME' => $archivoSimulado->getClientMimeType(),
                        'ruta_archivo' => $ubicacion,
                    ]
                );
            }

            $rutaImagen = public_path('img/comprobantes_prueba/kardex_prueba.pdf');
            if(File::exists($rutaImagen)){
                
                $archivoSimulado = new UploadedFile(
                    $rutaImagen,
                    'application/pdf',
                );
        
                $ubicacion = $archivoSimulado->store('archivos_kardex', 'public');
                $user->archivos()->create(
                    [   
                        'archivo_type' => 'kardex',
                        'MIME' => $archivoSimulado->getClientMimeType(),
                        'ruta_archivo' => $ubicacion,
                    ]
                );
            }     

        }

        $cantidad_a = 10; //Cantidad de usuarios A
        $cantidad_b = 10; //Cantidad de usuarios B

        //Usuarios tipo A
        for($i = 0; $i<=$cantidad_a; $i++){
            $tipo = 'A';
            generarUsuario($faker,$tipo,$sexo,$mascota,$padecimiento,$lifestyle,$carrera);

        }

        //Usuarios tipo B
        for($i = 0; $i<=$cantidad_b; $i++){
            $tipo = 'B';
            generarUsuario($faker,$tipo,$sexo,$mascota,$padecimiento,$lifestyle,$carrera);
        }

        User::where('tipo', 'A')
            ->whereNotNull('profile_update')
            ->first()
            ->update(['email' => 'example@gmail.com']);

        User::where('tipo', 'B')
            ->whereNotNull('profile_update')
            ->first()
            ->update(['email' => 'exampleB@gmail.com']);

        UserA::where('mascota', 'no')
        ->update(['num_mascotas' => 0]);

        UserB::where('mascota', 'no')
        ->update(['num_mascotas' => 0]);

        
    }

    
}
