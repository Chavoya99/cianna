<?php

use App\Models\UserA;
use App\Models\UserB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ProfileUpdate;
use App\Http\Middleware\ProfileUpdated;
use App\Http\Controllers\CasaController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserAMiddleware;
use App\Http\Middleware\UserBMiddleware;
use App\Http\Controllers\UserAController;
use App\Http\Controllers\UserBController;
use App\Http\Middleware\ProfileNotUpdated;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\HomeController;

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
            });

            //Nota: cuando se establezcan las nuevas rutas relacionadas a la casa se deberá implementar un redireccionamiento
            //para evitar que el usuario pueda entrar a configuracion de hogar sin antes completar el registro del mismo.
            Route::get('/configuracion_inicial_habitacion', [CasaController::class, 'configuracion_inicial_casa'])->name('config_hogar');
            Route::post('/guardar_configuracion_inicial_habitacion', [CasaController::class, 'guardar_configuracion_inicial_casa'])->name('guardar_hogar');

        });

        Route::middleware(UserBMiddleware::class)->group(function(){
            Route::controller(UserBController::class)->group(function(){
                Route::get('/homeB','homeB')->name('homeB');
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

            Route::get('vista_previa_roomie/{roomie}', 'vista_previa_roomie')->name('vista_previa_roomie');
            Route::get('ver_detalles_roomie/{roomie}', 'ver_detalles_roomie')->name('detalles_roomie');
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

/* QUITAR AL FINAL*/
Route::get('/usuarioA', function(){
    return view('userA.usera');
});

Route::get('/configuracion_hogar', function(){
    return view('userA.config-hogar');
});

Route::get('/home', function(){
    return view('profile.home');
});

Route::get('/account-settings', function(){
    return view('profile.account-settings');
});

Route::get('/my-profile', function(){
    return view('profile.my-profile');
});

Route::get('/detalles_hogar', function(){
    return view('profile.room-details');
});

Route::get('/ver_mas_hogar', function(){
    return view('profile.about-room');
});

Route::get('/vista_previa_roomie', function(){
    return view('profile.about-roomie');
});

Route::get('/detalles_roomie', function(){
    return view('profile.roomie-details');
});

Route::get('otros_hogares', function(){
    return view('profile.homes-list');
});

Route::get('postulacionesA', function(){
    return view('profile.requestsA');
});

Route::get('favsA', function(){
    return view('profile.favsA');
});