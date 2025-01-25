@extends('layouts.master')

@section('title', 'Editar Secretaria')

@section('content')

<h1 class="text-center mb-4">Editar Secretaria</h1>

<form action="{{ route('secretaria.update', $secretaria->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group mb-3">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $secretaria->nombre }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="apellido" class="form-label">Apellido:</label>
        <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $secretaria->apellido }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="id_secretaria" class="form-label">ID Secretaria:</label>
        <input type="number" id="id_secretaria" name="id_secretaria" class="form-control" value="{{ $secretaria->id_secretaria }}" required>
    </div>

    <div class="form-group mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="email" id="correo" name="correo" class="form-control" value="{{ $secretaria->correo }}" required>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('secretaria.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>

@endsection

