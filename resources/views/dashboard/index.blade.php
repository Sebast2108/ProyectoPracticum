@extends('layouts.master')

@section('title', 'Panel de Control')

@section('content')
<div class="container mt-4">
    <h1 class="mb-2">Panel de Control</h1>
    <p class="text-muted">Resumen general del sistema de gestión médica</p>

    {{-- Sección de Citas --}}
    <h4 class="mt-4">Gestión de Citas</h4>
    <div class="row">
        {{-- Total de Citas --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('citas.index') }}" class="text-decoration-none">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-calendar-check me-2"></i>Total de Citas</h5>
                            <p class="card-text display-6">{{ $totalCitas }}</p>
                        </div>
                        <small class="text-white-50">Actualizado: {{ now()->format('d/m/Y') }}</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Citas del Día --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="bi bi-clock-history me-2"></i>Citas de Hoy</h5>
                        <p class="card-text display-6">{{ $citasHoy }}</p>
                    </div>
                    <small class="text-white-50">Citas para el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>

        {{-- Citas Pendientes --}}
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="bi bi-exclamation-circle me-2"></i>Citas Pendientes</h5>
                        <p class="card-text display-6">{{ $citasPendientes }}</p>
                    </div>
                    <small class="text-white-50">Citas aún no atendidas</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de Personal Médico --}}
    <h4 class="mt-4">Equipo Médico y Personal</h4>
    <div class="row">
        {{-- Médicos --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('medico.index') }}" class="text-decoration-none">
                <div class="card text-white bg-success h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-person-badge me-2"></i>Médicos</h5>
                            <p class="card-text display-6">{{ $totalMedicos }}</p>
                        </div>
                        <small class="text-white-50">Incluye todas las especialidades</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Secretarias --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('secretaria.index') }}" class="text-decoration-none">
                <div class="card text-white bg-info h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-person-lines-fill me-2"></i>Secretarias</h5>
                            <p class="card-text display-6">{{ $totalSecretarias }}</p>
                        </div>
                        <small class="text-white-50">Personal administrativo de apoyo</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Gerentes --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('gerente.index') }}" class="text-decoration-none">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-briefcase me-2"></i>Gerentes</h5>
                            <p class="card-text display-6">{{ $totalGerentes }}</p>
                        </div>
                        <small class="text-white-50">Gestión y toma de decisiones</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Sección de Pacientes y Usuarios --}}
    <h4 class="mt-4">Pacientes y Usuarios</h4>
    <div class="row">
        {{-- Pacientes --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('paciente.index') }}" class="text-decoration-none">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Pacientes</h5>
                            <p class="card-text display-6">{{ $totalPacientes }}</p>
                        </div>
                        <small class="text-white-50">Incluye pacientes activos e inactivos</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Administradores --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('administrador.index') }}" class="text-decoration-none">
                <div class="card text-white bg-dark h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-person-gear me-2"></i>Administradores</h5>
                            <p class="card-text display-6">{{ $totalAdministradores }}</p>
                        </div>
                        <small class="text-white-50">Control total del sistema</small>
                    </div>
                </div>
            </a>
        </div>

        {{-- Total Usuarios --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('users.index') }}" class="text-decoration-none">
                <div class="card text-white bg-secondary h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="bi bi-people me-2"></i>Usuarios Registrados</h5>
                            <p class="card-text display-6">{{ $totalUsuarios }}</p>
                        </div>
                        <small class="text-white-50">Todos los roles incluidos</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
