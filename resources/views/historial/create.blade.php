@extends('layouts.master')

@section('title', 'Crear Historial Médico')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Crear Nuevo Historial Médico</h1>
    <form action="{{ route('historial.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="alergias" class="form-label">Alergias:</label>
            <input type="text" id="alergias" name="alergias" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="enfermedades_previas" class="form-label">Enfermedades Previas:</label>
            <input type="text" id="enfermedades_previas" name="enfermedades_previas" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="id_historial" class="form-label">ID Historial:</label>
            <input type="number" id="id_historial" name="id_historial" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="tratamientos" class="form-label">Tratamientos:</label>
            <input type="text" id="tratamientos" name="tratamientos" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('historial.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
