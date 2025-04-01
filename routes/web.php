<?php

use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ProfileUpdate;
use App\Http\Middleware\ProfileUpdated;
use App\Http\Controllers\CasaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserAMiddleware;
use App\Http\Middleware\UserBMiddleware;
use App\Http\Controllers\UserAController;
use App\Http\Controllers\UserBController;
use App\Http\Middleware\ProfileNotUpdated;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/home_guest', [HomeController::class, 'home_invitado'])->middleware('guest')->name('home_guest');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),
    'verified',])->group(function () {

    Route::middleware(ProfileUpdated::class)->group(function(){
        
        Route::middleware(AdminMiddleware::class)->group(function(){
            Route::get('/homeAdmin', function(){
                return 'homeAdmin';
            })->name('homeAdmin');
        });

        Route::middleware(UserAMiddleware::class)->group(function(){
            Route::controller(UserAController::class)->group(function(){
                Route::get('/homeA','homeA')->name('homeA');
                Route::get('listado_recomendaciones_roomies', 'recomendaciones_a')->name('recomendaciones_a');
            });

            //Nota: cuando se establezcan las nuevas rutas relacionadas a la casa se deberá implementar un redireccionamiento
            //para evitar que el usuario pueda entrar a configuracion de hogar sin antes completar el registro del mismo.
            Route::get('/configuracion_inicial_habitacion', [CasaController::class, 'configuracion_inicial_casa'])->name('config_hogar');
            Route::post('/guardar_configuracion_inicial_habitacion', [CasaController::class, 'guardar_configuracion_inicial_casa'])->name('guardar_hogar');
            Route::get('/configuracion_habitacion', [Casacontroller::class, 'configurar_casa_guardada'])->name('configurar_casa');
            Route::post('/actualizar_informacion_habitacion', [CasaController::class, 'actualizar_informacion_casa'])->name('actualizar_informacion_casa');
            
            
        });

        Route::middleware(UserBMiddleware::class)->group(function(){
            Route::controller(UserBController::class)->group(function(){
                Route::get('/homeB','homeB')->name('homeB');

                Route::get('listado_recomendaciones_roomies_habitacion', 'recomendaciones_b_roomies')->name('recomendaciones_b_roomies');
                Route::get('listado_recomendaciones_habitaciones', 'recomendaciones_b_casas')->name('recomendaciones_b_casas');
            });
            
        });//Final Middleware UserB

        Route::controller(HomeController::class)->group(function(){
            Route::get('/configuracion_cuenta', 'configuracion_cuenta')->name('config_cuenta');
            Route::post('/configuracion_cuenta',  'actualizar_cuenta')->name('actualizar_cuenta');

            Route::get('/mi_perfil', 'ver_perfil_usuario')->name('mi_perfil');
            Route::post('descargar_kardex/usuario_{usuario}', 'descargar_kardex')->name('descargar_kardex');
            Route::post('ver_kardex/usuario_{usuario}', 'ver_kardex')->name('ver_kardex');

            Route::get('vista_previa_habitacion/{casa}', 'vista_previa_casa')->name('vista_previa_casa');
            Route::get('/ver_detalles_habitacion/{casa}', 'ver_detalles_casa')->name('detalles_casa');
            
            Route::get('listado_habitaciones', 'listado_casas')->name('listado_casas');
            Route::get('listado_roomies', 'listado_roomies')->name('listado_roomies');

            Route::get('vista_previa_roomie/{roomie}', 'vista_previa_roomie')->name('vista_previa_roomie');
            Route::get('ver_detalles_roomie/{roomie}', 'ver_detalles_roomie')->name('detalles_roomie');

            
            Route::get('mis_favoritos', 'ver_favoritos')->name( 'ver_favoritos');

            Route::get('busqueda', 'busquedaRoomies')->name('busquedaRoomies');
            Route::get('busquedaHabitaciones', 'busquedaHabitaciones')->name('busquedaHabitaciones');

            
        });

        Route::controller(ChatController::class)->group(function(){
            Route::post('crear_chat', 'crear_chat')->name('crear_chat');
            Route::get('chat/{chat_id}/{room_id}/{otherUserId}', 'mostrar_chat')->name('chat_privado');
            Route::get('lista_chats', 'lista_chats')->name('lista_chats');
            Route::post('ver_chat/{user_id_2}', 'redireccionar_chat')->name('ver_chat');
        });

        Route::controller(PostulacionController::class)->group(function(){
            Route::get('ver_postulaciones', 'ver_postulaciones')->name('ver_postulaciones');
            Route::get('lista_postulaciones', 'ver_lista_completa_postulaciones')->name('lista_postulaciones');
            Route::get('lista_postulaciones_pendientes', 'lista_postulaciones_pendientes')->name('lista_postulaciones_pendientes');
            Route::post('aceptar_postulacion/{postulacion}', 'aceptar_postulacion')->name('aceptar_postulacion');
        });
        
        
        
    });//Final middleware ProfileUpdated


    Route::get('/configuracion_inicial_cuenta', [LoginRegisterController::class, 
    'ver_configuracion_inicial_cuenta'])->name('ver_configuracion_inicial_cuenta')->middleware(ProfileNotUpdated::class);
    
    Route::post('/configuracion_inicial_cuenta', [LoginRegisterController::class, 
    'guardar_configuracion_inicial_cuenta'])->name('guardar_configuracion_inicial_cuenta')->middleware(ProfileNotUpdated::class);
    
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');

    Route::get('/redirigir', [LoginRegisterController::class, 'redirectTo']);
    
});//Final middleware Auth

