@extends('layouts.master')

@section('title', 'Detalles de la Secretaria')

@section('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Detalles de la Secretaria</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID Secretaria:</strong> {{ $secretaria->id_secretaria }}</p>
            <p><strong>Nombre:</strong> {{ $secretaria->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $secretaria->apellido }}</p>
            <p><strong>Correo:</strong> {{ $secretaria->correo }}</p>
            <a href="{{ route('secretaria.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
</div>

@endsection
