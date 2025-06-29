@extends('layouts.master')

@section('title', 'Editar Historial Médico')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-detalles" style="max-width: 700px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Historial Médico</h5>
        </div>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <strong>¡Atención!</strong> Corrige los siguientes errores:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('historial.update', $historial->id) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo oculto para cita_id --}}
            <input type="hidden" name="cita_id" value="{{ $historial->cita_id }}">

            {{-- Mostrar médico y especialidad --}}
            <div class="mb-3">
                <label class="form-label">Médico:</label>
                <input type="text" class="form-control" 
                       value="{{ $historial->cita->medico->nombre ?? 'N/A' }} {{ $historial->cita->medico->apellido ?? '' }} - {{ $historial->cita->medico->especialidad->nombre ?? 'N/A' }}" 
                       disabled>
            </div>

            {{-- Fecha de la cita --}}
            <div class="mb-3">
                <label class="form-label">Fecha de la Cita:</label>
                <input type="text" class="form-control" 
                       value="{{ \Carbon\Carbon::parse($historial->cita->fecha ?? now())->format('d/m/Y') }}" disabled>
            </div>

            {{-- Síntomas --}}
            <div class="mb-3">
                <label for="sintomas" class="form-label">Síntomas:</label>
                <textarea id="sintomas" name="sintomas" class="form-control" rows="3" required>{{ old('sintomas', $historial->sintomas) }}</textarea>
                <div class="invalid-feedback">Ingrese los síntomas.</div>
            </div>

            {{-- Diagnóstico --}}
            <div class="mb-3">
                <label for="diagnostico" class="form-label">Diagnóstico:</label>
                <textarea id="diagnostico" name="diagnostico" class="form-control" rows="3" required>{{ old('diagnostico', $historial->diagnostico) }}</textarea>
                <div class="invalid-feedback">Ingrese el diagnóstico.</div>
            </div>

            {{-- Tratamiento --}}
            <div class="mb-3">
                <label for="tratamientos" class="form-label">Tratamiento:</label>
                <textarea id="tratamientos" name="tratamientos" class="form-control" rows="3" required>{{ old('tratamiento', $historial->tratamiento) }}</textarea>
                <div class="invalid-feedback">Ingrese el tratamiento.</div>
            </div>

            {{-- Observaciones --}}
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <textarea id="observaciones" name="observaciones" class="form-control" rows="3">{{ old('observaciones', $historial->observaciones) }}</textarea>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('historial.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

{{-- Script de validación --}}
<script>
(() => {
    'use strict';
    document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', e => {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
})();
</script>
@endsection
