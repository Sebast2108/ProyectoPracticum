@extends('layouts.master')

@section('title', 'Crear Secretaria')

@section('content')

<h1 class="text-center mb-4">Crear Nueva Secretaria</h1>

<form action="{{ route('secretaria.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="apellido" class="form-label">Apellido:</label>
        <input type="text" id="apellido" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="id_secretaria" class="form-label">ID Secretaria:</label>
        <input type="number" id="id_secretaria" name="id_secretaria" class="form-control" value="{{ old('id_secretaria') }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" id="correo" name="correo" class="form-control" value="{{ old('correo') }}" required>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('secretaria.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

@endsection

