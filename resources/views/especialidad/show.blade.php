@extends('layouts.master')

@section('title', 'Detalles de la Especialidad')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado con tarjeta --}}
    <div class="card shadow-sm card-detalles">
        {{-- Cabecera con fondo primario --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Detalles de la Especialidad</h5>
        </div>

        {{-- Lista de detalles centrada --}}
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item"><strong>ID Especialidad:</strong> {{ $especialidad->id_especialidad }}</li>
            <li class="list-group-item"><strong>Nombre:</strong> {{ $especialidad->nombre }}</li>
            <li class="list-group-item"><strong>Descripción:</strong> {{ $especialidad->descripcion }}</li>
        </ul>

        {{-- Botón volver --}}
        <div class="card-body text-center">
            <a href="{{ route('especialidad.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
