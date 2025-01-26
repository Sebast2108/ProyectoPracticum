@extends('layouts.master')

@section('title', 'Crear Estadística')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Crear Nueva Estadística</h1>
    <form action="{{ route('estadisticas.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="id_estadistica" class="form-label">ID Estadística:</label>
            <input type="number" id="id_estadistica" name="id_estadistica" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="valor" class="form-label">Calificación:</label>
            <input type="number" id="valor" name="valor" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('estadisticas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
