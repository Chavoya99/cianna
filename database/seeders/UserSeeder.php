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
            'email' => 'pruebaA@alumnos.udg.mx',
            'tipo' => 'A'
        ]);

        User::factory()->create([
            'name' => 'pruebaB',
            'apellido' => 'B',
            'email' => 'pruebaB@alumnos.udg.mx',
            'tipo' => 'B'
        ]);


        $sexo = ['Masculino', 'Femenino'];
        $mascota = ['si','no'];
        $padecimiento = ['si', 'no'];
        $lifestyle = ['d','t','a'];
        $carrera = ['ing_alim_biot' ,'ing_biom','ing_civi',
        'ing_comp','ing_com_elec','ing_log_trans',
        'ing_topo','ing_foto','ing_indu',
        'ing_info','ing_meca','ing_quim',
        'ing_robo','lic_cien_mate','lic_fis',
        'lic_mate','lic_quim','lic_qfb'];
    

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
            $nombres_hombres = [
                'José', 'Juan', 'Carlos', 'Luis', 'Miguel', 'Pedro', 'Alejandro', 'Fernando', 'Ricardo', 'Eduardo',
                'Jorge', 'Manuel', 'Francisco', 'Antonio', 'Raúl', 'Adrián', 'Héctor', 'Salvador', 'Jesús', 'Rubén',
                'Omar', 'Emilio', 'Andrés', 'Ernesto', 'Víctor', 'Hugo', 'Ramón', 'César', 'David', 'Martín',
                'Arturo', 'Gerardo', 'Esteban', 'Roberto', 'Felipe', 'Gustavo', 'Cristian', 'Abel', 'Rodrigo', 'Ismael',
                'Julio', 'Mauricio', 'Efraín', 'Noé', 'Jaime', 'Óscar', 'Braulio', 'Alan', 'Iván', 'Samuel',
                'Erick', 'Diego', 'Fabián', 'Jonathan', 'Baltazar', 'Guillermo', 'Leonardo', 'Benjamín', 'Ángel', 'Ezequiel',
                'Armando', 'Bruno', 'Camilo', 'Damián', 'Gael', 'Humberto', 'Luciano', 'Maximiliano', 'Nicolás', 'Patricio'
            ];
            
            $nombres_mujeres = [
                'María', 'Guadalupe', 'Carmen', 'Josefina', 'Ana', 'Leticia', 'Rosa', 'Beatriz', 'Laura', 'Patricia',
                'Gabriela', 'Martha', 'Alejandra', 'Verónica', 'Silvia', 'Norma', 'Lorena', 'Claudia', 'Elizabeth', 'Fernanda',
                'Daniela', 'Adriana', 'Yolanda', 'Sara', 'Sofía', 'Diana', 'Teresa', 'Isabel', 'Margarita', 'Andrea',
                'Paola', 'Marisol', 'Fátima', 'Rebeca', 'Mariana', 'Gloria', 'Ximena', 'Natalia', 'Camila', 'Montserrat',
                'Carolina', 'Julieta', 'Valeria', 'Alicia', 'Celeste', 'Graciela', 'Estefanía', 'Ivonne', 'Liliana', 'Melissa',
                'Rocío', 'Susana', 'Berenice', 'Angélica', 'Raquel', 'Magdalena', 'Itzel', 'Nayeli', 'Araceli', 'Evelyn',
                'Elsa', 'Ingrid', 'Aurora', 'Janeth', 'Guillermina', 'Miranda', 'Catalina', 'Perla', 'Victoria', 'Regina'
            ];

            $user = User::factory()->create([
                'profile_update' => now('America/Belize'),
                'tipo' => $tipo,
            ]);

            if($tipo == 'A'){
                $user->user_a()->create([
                    'edad' => random_int(18,35),
                    'sexo' => $sexo[array_rand($sexo, 1)],
                    'descripcion' => 'descripcion',
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
                    'descripcion' => 'descripcion',
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
                    $user->update(['name' => $faker->randomElement($nombres_hombres)]);
                    $rutaImagen = public_path('img/personas/Hombres/img_h_'.$GLOBALS['hombres'].'.png');
                    
                    if(!File::exists($rutaImagen)){
                        $rutaImagen = public_path('img/masculino.jpg');

                    }
                    $GLOBALS['hombres']++;
                }else{
                    $user->update(['name' => $faker->randomElement($nombres_mujeres)]);
                    $rutaImagen = public_path('img/personas/Mujeres/img_m_'.$GLOBALS['mujeres'].'.png');
                    
                    if(!File::exists($rutaImagen)){
                        $rutaImagen = public_path('img/femenino.jpg');

                    }
                    $GLOBALS['mujeres']++;
                } 
            }else{
                if($user->user_b->sexo == 'Masculino'){
                    $user->update(['name' => $faker->randomElement($nombres_hombres)]);
                    $rutaImagen = public_path('img/personas/Hombres/img_h_'.$GLOBALS['hombres'].'.png');
                    
                    if(!File::exists($rutaImagen)){
                        $rutaImagen = public_path('img/masculino.jpg');

                    }
                    $GLOBALS['hombres']++;

                }else{
                    $user->update(['name' => $faker->randomElement($nombres_mujeres)]);
                    $rutaImagen = public_path('img/personas/Mujeres/img_m_'.$GLOBALS['mujeres'].'.png');
                    
                    if(!File::exists($rutaImagen)){
                        $rutaImagen = public_path('img/femenino.jpg');

                    }
                    $GLOBALS['mujeres']++;
                } 
            }  

            //Actualizar descricion personalizada
            $descripcion = sprintf(
                "%s, mi nombre es %s, me considero una persona %s, que disfruta de %s y sueña con %s. Me conocen por ser %s y %s.",
                $faker->randomElement(['Hola que tal', 'Hola', 'Hey hola', 'Hey que tal', 'Hey aquí buscando roomie', 'Hola hola']),
                $user->name,
                $faker->randomElement(['optimista', 'creativa', 'detallista', 'introvertida', 'extrovertida']),
                $faker->randomElement(['leer libros', 'explorar la naturaleza', 'escuchar música', 'jugar videojuegos', 'cocinar']),
                $faker->randomElement(['viajar por el mundo', 'aprender un nuevo idioma', 'escribir un libro', 'crear una empresa']),
                $faker->randomElement(['amable', 'curiosa', 'trabajadora', 'ingeniosa']),
                $faker->randomElement(['organizada', 'aventurera', 'sociable', 'tranquila'])
            );

            if($tipo == 'A'){
                $user->user_a()->update(['descripcion' => $descripcion]);
            }else{
                $user->user_b()->update(['descripcion' => $descripcion]);
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

        $cantidad_a = 50; //Cantidad de usuarios A
        $cantidad_b = 50; //Cantidad de usuarios B
        global $mujeres;
        global $hombres;
        $mujeres = 1;
        $hombres = 1;
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
            ->update(['email' => 'example@alumnos.udg.mx']);

        User::where('tipo', 'B')
            ->whereNotNull('profile_update')
            ->first()
            ->update(['email' => 'exampleB@alumnos.udg.mx']);

        //Actualizar todos los emails por alumnos.udg.mx
        $usersA = User::where('tipo', 'A')
            ->whereNotNull('profile_update')
            ->where('email', '!=', 'example@alumnos.udg.mx')

            ->get();
        $usersB = User::where('tipo', 'B')
            ->whereNotNull('profile_update')
            ->where('email', '!=', 'exampleB@alumnos.udg.mx')
            ->get();

        function quitarAcentos($cadena) {
            $acentos = [
                'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u',
                'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U',
                'ñ' => 'n', 'Ñ' => 'N'
            ];
            return strtr($cadena, $acentos);
        }
        
        function generar_email($nombre, $apellido){
            $partes_nombre = explode(" ", $nombre);
            $partes_apellido = explode(" ", $apellido);
            $numero = rand(1000, 9999);
            
            $email = quitarAcentos(strtolower($partes_nombre[0]))."."
            .quitarAcentos(strtolower($partes_apellido[0])).$numero."@alumnos.udg.mx";

            return $email;
        }
            
        foreach($usersA as $user){
            $email = generar_email($user->name, $user->apellido );
            $user->update(['email'=> $email]);
        }

        foreach($usersB as $user){
            $email = generar_email($user->name, $user->apellido );
            $user->update(['email'=> $email]);
        }

        UserA::where('mascota', 'no')
        ->update(['num_mascotas' => 0]);

        UserB::where('mascota', 'no')
        ->update(['num_mascotas' => 0]);

        
    }

    
}
