@extends('layouts.master')

@section('title', 'Detalles del Historial Médico')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-detalles" style="max-width: 700px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Información del Historial Médico</h5>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center">
                <strong>Cita:</strong> 
                {{ $historial->cita->paciente->nombre ?? '' }} {{ $historial->cita->paciente->apellido ?? '' }} — 
                {{ \Carbon\Carbon::parse($historial->cita->fecha ?? null)->format('d/m/Y') ?? 'N/A' }}
            </li>
            <li class="list-group-item text-center">
                <strong>Médico:</strong> {{ $historial->cita->medico->nombre ?? 'N/A' }} {{ $historial->cita->medico->apellido ?? '' }}
            </li>
            <li class="list-group-item text-center">
                <strong>Especialidad:</strong> {{ $historial->cita->medico->especialidad->nombre ?? 'N/A' }}
            </li>
            <li class="list-group-item">
                <strong>Síntomas:</strong><br>
                {!! nl2br(e($historial->sintomas)) !!}
            </li>
            <li class="list-group-item">
                <strong>Diagnóstico:</strong><br>
                {!! nl2br(e($historial->diagnostico)) !!}
            </li>
            <li class="list-group-item">
                <strong>Tratamiento:</strong><br>
                {!! nl2br(e($historial->tratamientos)) !!}
            </li>
            <li class="list-group-item">
                <strong>Observaciones:</strong><br>
                {!! nl2br(e($historial->observaciones)) !!}
            </li>
        </ul>

        <div class="card-body text-center">
            <a href="{{ route('historial.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
