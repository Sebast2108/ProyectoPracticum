<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use Carbon\Carbon;            // <─ importa Carbon

class DashboardController extends Controller
{
    public function index()
    {
        // Totales generales
        $totalCitas           = Citas::count();
        $totalMedicos         = Medico::count();
        $totalPacientes       = Paciente::count();
        $totalUsuarios        = User::count();

        // Totales por rol
        $totalSecretarias     = User::where('role', 'secretaria')->count();
        $totalGerentes        = User::where('role', 'gerente')->count();
        $totalAdministradores = User::where('role', 'administrador')->count();

        // ► NUEVAS métricas
        $citasHoy        = Citas::whereDate('fecha', Carbon::today())->count();
        $citasPendientes = Citas::where('estado', 'Pendiente')->count();

        return view('dashboard.index', compact(
            'totalCitas',
            'totalMedicos',
            'totalPacientes',
            'totalUsuarios',
            'totalSecretarias',
            'totalGerentes',
            'totalAdministradores',
            'citasHoy',            
            'citasPendientes'      
        ));
    }
}
