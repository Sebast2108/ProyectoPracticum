@extends('layouts.master')

@section('title', 'Detalles de la Secretaria')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado con margen superior --}}
    <div class="card shadow-sm">
        {{-- Tarjeta con sombra y presentación compacta --}}
        <div class="card-header bg-primary text-white text-center">
            {{-- Cabecera con estilo --}}
            <h5 class="mb-0">Detalles de la Secretaria</h5>
        </div>
        <ul class="list-group list-group-flush text-center">
            {{-- Lista de detalles centrada --}}
            <li class="list-group-item"><strong>Nombre:</strong> {{ $secretaria->nombre }}</li>
            <li class="list-group-item"><strong>Apellido:</strong> {{ $secretaria->apellido }}</li>
            <li class="list-group-item"><strong>ID Secretaria:</strong> {{ $secretaria->id_secretaria }}</li>
            <li class="list-group-item"><strong>Correo:</strong> {{ $secretaria->email }}</li>
        </ul>
        <div class="card-body text-center">
            {{-- Botón para volver al listado de secretarias --}}
            <a href="{{ route('secretaria.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
