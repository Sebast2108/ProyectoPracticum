@extends('layouts.master')

@section('title', 'Editar Historial Médico')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Historial Médico</h1>
    <form action="{{ route('historial.update', $historial->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="alergias" class="form-label">Alergias:</label>
            <input type="text" id="alergias" name="alergias" class="form-control" value="{{ $historial->alergias }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="enfermedades_previas" class="form-label">Enfermedades Previas:</label>
            <input type="text" id="enfermedades_previas" name="enfermedades_previas" class="form-control" value="{{ $historial->enfermedades_previas }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="id_historial" class="form-label">ID Historial:</label>
            <input type="number" id="id_historial" name="id_historial" class="form-control" value="{{ $historial->id_historial }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="tratamientos" class="form-label">Tratamientos:</label>
            <input type="text" id="tratamientos" name="tratamientos" class="form-control" value="{{ $historial->tratamientos }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('historial.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
