<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', function () {
        return view('dashboard');})->name('dashboard');
});

Route::get('/formularioRegistroA', function(){
    return '<a href="/formularioRegistroB"> To form B</a>';
})->middleware('auth', 'hasNoUserType');

Route::get('/formularioRegistroB', function(){
    return '<a href="/formularioRegistroA"> To form A</a>';
})->middleware('auth', 'hasNoUserType');

Route::get('dashAdmin', function(){
    return 'dashAdmin';
})->name('dashAdmin')->middleware('auth', 'hasUserType:admin');

Route::get('/dashA', function(){
    return 'dashA';
})->name('dashA')->middleware('auth', 'hasUserType:A');

Route::get('/dashB', function(){
    return 'dashB';
})->name('dashB')->middleware('auth', 'hasUserType:B');

