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
    return view('welcome');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/agendacita', function () {
    return view('agendacita');
});


Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('paciente', PacienteController::class);

Route::resource('doctor', DoctorController::class);
 

