@extends('layouts.master')

@section('title', 'Editar Estadística')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Estadística</h1>
    <form action="{{ route('estadisticas.update', $estadistica->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="{{ $estadistica->descripcion }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="id_estadistica" class="form-label">ID Estadística:</label>
            <input type="number" id="id_estadistica" name="id_estadistica" class="form-control" value="{{ $estadistica->id_estadistica }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="valor" class="form-label">Calificación:</label>
            <input type="number" id="valor" name="valor" class="form-control" step="0.01" value="{{ $estadistica->valor }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('estadisticas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
