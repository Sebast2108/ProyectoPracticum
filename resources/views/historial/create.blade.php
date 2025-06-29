@extends('layouts.master')

@section('title', 'Crear Historial Médico')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-detalles">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Crear Nuevo Historial Médico</h5>
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

        {{-- Formulario de creación --}}
        <form action="{{ route('historial.store') }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf

            {{-- Selección de cita --}}
            <div class="mb-3">
                <label for="cita_id" class="form-label">Cita:</label>

                @if(isset($citaIdSeleccionada) && $citaIdSeleccionada)
                    @php
                        $citaSeleccionada = $citas->firstWhere('id', $citaIdSeleccionada);
                    @endphp
                    <input type="hidden" name="cita_id" value="{{ $citaIdSeleccionada }}">
                    <input type="text" class="form-control" disabled
                        value="{{ 
                            $citaSeleccionada 
                                ? $citaSeleccionada->paciente->nombre . ' ' . $citaSeleccionada->paciente->apellido . ' - ' . 
                                  \Carbon\Carbon::parse($citaSeleccionada->fecha)->format('d/m/Y') . ' - ' . 
                                  $citaSeleccionada->medico->nombre . ' ' . $citaSeleccionada->medico->apellido . ' - ' . 
                                  $citaSeleccionada->medico->especialidad->nombre 
                                : 'Cita no disponible' 
                        }}">
                @else
                    <select id="cita_id" name="cita_id" class="form-select" required>
                        <option value="" disabled {{ !old('cita_id') ? 'selected' : '' }}>Seleccione una cita</option>
                        @foreach ($citas as $cita)
                            <option value="{{ $cita->id }}" {{ old('cita_id') == $cita->id ? 'selected' : '' }}>
                                {{ $cita->paciente->nombre ?? '' }} {{ $cita->paciente->apellido ?? '' }} - 
                                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }} - 
                                {{ $cita->medico->nombre ?? '' }} {{ $cita->medico->apellido ?? '' }} - 
                                {{ $cita->medico->especialidad->nombre ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione una cita.</div>
                @endif
            </div>

            {{-- Síntomas --}}
            <div class="mb-3">
                <label for="sintomas" class="form-label">Síntomas:</label>
                <textarea id="sintomas" name="sintomas" class="form-control" rows="3" required>{{ old('sintomas') }}</textarea>
                <div class="invalid-feedback">Ingrese los síntomas.</div>
            </div>

            {{-- Diagnóstico --}}
            <div class="mb-3">
                <label for="diagnostico" class="form-label">Diagnóstico:</label>
                <textarea id="diagnostico" name="diagnostico" class="form-control" rows="3" required>{{ old('diagnostico') }}</textarea>
                <div class="invalid-feedback">Ingrese el diagnóstico.</div>
            </div>

            {{-- Tratamiento --}}
            <div class="mb-3">
                <label for="tratamientos" class="form-label">Tratamiento:</label>
                <textarea id="tratamientos" name="tratamientos" class="form-control" rows="3" required>{{ old('tratamiento') }}</textarea>
                <div class="invalid-feedback">Ingrese el tratamiento.</div>
            </div>

            {{-- Observaciones --}}
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <textarea id="observaciones" name="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('historial.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar Historial</button>
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
