<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\GerenteController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/medicos/{medico}/dias-agenda', [CitasController::class, 'getDiasAgendaMedico']);
Route::get('/medicos/{medico}/agenda', [CitasController::class, 'getAgendaMedico']);

Route::resource('paciente', PacienteController::class);

Route::resource('medico', MedicoController::class);

Route::resource('especialidad', EspecialidadController::class);

Route::resource('agenda', AgendaController::class);

Route::resource('administrador', AdministradorController::class);

Route::resource('citas', CitasController::class);

Route::resource('estadisticas', EstadisticasController::class);

Route::resource('gerente', GerenteController::class);

Route::resource('historial', HistorialController::class);

Route::resource('reporte', ReporteController::class);

Route::resource('secretaria', SecretariaController::class)->parameters([
    'secretaria' => 'secretaria'
]);

// Solo accesible por administradores
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::resource('users', UsersController::class);
});

Route::resource('dashboard', DashboardController::class);

//Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

