@extends('layouts.master')

@section('title', 'Detalles del Gerente')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado con margen superior --}}
    <div class="card shadow-sm card-detalles">
        {{-- Tarjeta con sombra y ancho fijo para presentación compacta --}}
        <div class="card-header bg-primary text-white text-center">
            {{-- Cabecera con fondo azul y texto blanco, título centrado --}}
            <h5 class="mb-0">Detalles del Gerente</h5>
        </div>
        <ul class="list-group list-group-flush text-center">
            {{-- Lista con información centrada --}}
            <li class="list-group-item"><strong>ID Gerente:</strong> {{ $gerente->id_gerente }}</li>
            <li class="list-group-item"><strong>Nombre:</strong> {{ $gerente->nombre }}</li>
            <li class="list-group-item"><strong>Apellido:</strong> {{ $gerente->apellido }}</li>
            <li class="list-group-item"><strong>Correo:</strong> {{ $gerente->email }}</li>
        </ul>
        <div class="card-body text-center">
            <a href="{{ route('gerente.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
