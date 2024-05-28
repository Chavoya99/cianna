<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ProfileUpdate;
use App\Http\Middleware\ProfileUpdated;
use App\Http\Middleware\ProfileNotUpdated;
use App\Http\Middleware\UserAMiddleware;
use App\Http\Middleware\UserBMiddleware;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),
    'verified',])->group(function () {

    Route::middleware(ProfileUpdated::class)->group(function(){
        
        Route::middleware(AdminMiddleware::class)->group(function(){
            Route::get('/homeAdmin', function(){
                return 'homeAdmin';
            })->name('homeAdmin');
        });

        Route::middleware(UserAMiddleware::class)->group(function(){
            Route::get('/homeA', function(){
                return 'homeA';
            })->name('homeA');
        });

        Route::middleware(UserBMiddleware::class)->group(function(){
            Route::get('/homeB', function(){
                return 'homeB';
            })->name('homeB');
        });
        
        
    });


    Route::get('/formularioRegistroA', function(){
        return 'formA';
    })->middleware(UserAMiddleware::class,ProfileNotUpdated::class);
    
    Route::get('/formularioRegistroB', function(){
        return 'FormB';
    })->middleware(UserBMiddleware::class, ProfileNotUpdated::class);
        

    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');

    Route::get('/redirigir', [LoginRegisterController::class, 'redirectTo']);
    
});



