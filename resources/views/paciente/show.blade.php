@extends('layouts.master')

@section('title', 'Detalles del Paciente')

@section('content')

{{-- Contenedor principal centrado --}}
<div class="container form-container">

    {{-- Tarjeta con detalles del paciente --}}
    <div class="card shadow-sm form-card compact">

        {{-- Cabecera con fondo primario y texto blanco --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Detalles del Paciente</h5>
        </div>

        {{-- Lista de datos del paciente --}}
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item"><strong>Nombre:</strong> {{ $paciente->nombre }}</li>
            <li class="list-group-item"><strong>Apellido:</strong> {{ $paciente->apellido }}</li>
            <li class="list-group-item"><strong>ID Paciente:</strong> {{ $paciente->id_paciente }}</li>
            <li class="list-group-item"><strong>Correo:</strong> {{ $paciente->email }}</li>
            <li class="list-group-item"><strong>Historial Médico:</strong> {{ $paciente->historial_medico }}</li>
        </ul>

        {{-- Botón para regresar al listado --}}
        <div class="card-body text-center">
            <a href="{{ route('paciente.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
