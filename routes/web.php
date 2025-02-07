<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SecretariaController;
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

Route::resource('medico', MedicoController::class);

Route::resource('administrador', AdministradorController::class);

Route::resource('citas', CitasController::class);

Route::resource('estadisticas', EstadisticasController::class);

Route::resource('gerente', GerenteController::class);

Route::resource('historial', HistorialController::class);

Route::resource('reporte', ReporteController::class);

Route::resource('secretaria', SecretariaController::class);




