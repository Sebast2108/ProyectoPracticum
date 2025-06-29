@extends('layouts.master')

@section('title', 'Detalle de Usuario')

@section('content')

{{-- Contenedor centrado con margen superior y flexbox --}}
<div class="container form-container d-flex justify-content-center">

    {{-- Tarjeta con sombra y ancho máximo para presentación compacta --}}
    <div class="card shadow-sm form-card-narrow">

        {{-- Encabezado con fondo primario y texto blanco centrado --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Detalle del Usuario</h5>
        </div>

        {{-- Lista de atributos del usuario centrada --}}
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
            <li class="list-group-item"><strong>Nombre:</strong> {{ $user->name }}</li>
            <li class="list-group-item"><strong>Correo Electrónico:</strong> {{ $user->email }}</li>
            <li class="list-group-item"><strong>Rol:</strong> {{ ucfirst($user->role) }}</li>
            <li class="list-group-item"><strong>Fecha de Registro:</strong> {{ optional($user->created_at)->format('d/m/Y H:i') }}</li>
        </ul>

        {{-- Botón para volver al listado --}}
        <div class="card-body text-center">
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>

    </div>

</div>

@endsection
