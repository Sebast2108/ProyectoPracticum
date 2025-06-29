@extends('layouts.master')

@section('title', 'Detalles del Administrador')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado usando flexbox de Bootstrap --}}
    <div class="card shadow-sm card-detalles">
        {{-- Tarjeta con sombra y ancho fijo para compactar contenido --}}
        <div class="card-header bg-primary text-white text-center">
            {{-- Cabecera con fondo azul y texto blanco, título centrado --}}
            <h5 class="mb-0">Detalles del Administrador</h5>
        </div>
        <ul class="list-group list-group-flush text-center">
            {{-- Lista de detalles centrada para presentación compacta --}}
            <li class="list-group-item"><strong>ID Administrador:</strong> {{ $administrador->id_administrador }}</li>
            <li class="list-group-item"><strong>Nombre:</strong> {{ $administrador->nombre }}</li>
            <li class="list-group-item"><strong>Apellido:</strong> {{ $administrador->apellido }}</li>
            <li class="list-group-item"><strong>Correo:</strong> {{ $administrador->email }}</li>
        </ul>
        <div class="card-body text-center">
            <a href="{{ route('administrador.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
