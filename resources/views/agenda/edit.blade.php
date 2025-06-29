@extends('layouts.master')

@section('title', 'Editar Agenda')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado usando flexbox --}}
    <div class="card shadow-sm">
        
        {{-- Cabecera con fondo primario y texto blanco --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Agenda</h5>
        </div>

        {{-- Mostrar errores de validación --}}
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

        {{-- Formulario de edición --}}
        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Selección de días de atención --}}
            <div class="mb-3">
                <label class="form-label">Días de Atención</label>
                @php
                    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                    $diasSeleccionados = old('dias', $agenda->dias ?? []);
                @endphp
                <div class="d-flex flex-wrap gap-2">
                    @foreach($dias as $dia)
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="dia_{{ $dia }}" 
                                name="dias[]" 
                                value="{{ $dia }}"
                                {{ in_array($dia, $diasSeleccionados) ? 'checked' : '' }}>
                            <label class="form-check-label" for="dia_{{ $dia }}">{{ $dia }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-text">Seleccione uno o más días de atención.</div>
            </div>

            {{-- Selección de hora de inicio --}}
            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de inicio</label>
                <select id="hora_inicio" name="hora_inicio" class="form-select" required>
                    <option value="" disabled>Seleccione hora de inicio</option>
                    @php
                        $start = strtotime('08:00');
                        $end = strtotime('18:00');
                        $interval = 15 * 60;
                        $valorHoraInicio = old('hora_inicio', $agenda->hora_inicio);
                    @endphp
                    @for ($time = $start; $time <= $end; $time += $interval)
                        @php $timeStr = date('H:i', $time); @endphp
                        <option value="{{ $timeStr }}" {{ $valorHoraInicio == $timeStr ? 'selected' : '' }}>
                            {{ $timeStr }}
                        </option>
                    @endfor
                </select>
                <div class="invalid-feedback">Ingrese la hora de inicio.</div>
            </div>

            {{-- Selección de hora de fin --}}
            <div class="mb-4">
                <label for="hora_fin" class="form-label">Hora de fin</label>
                <select id="hora_fin" name="hora_fin" class="form-select" required>
                    <option value="" disabled>Seleccione hora de fin</option>
                    @php
                        $valorHoraFin = old('hora_fin', $agenda->hora_fin);
                    @endphp
                    @for ($time = $start; $time <= $end; $time += $interval)
                        @php $timeStr = date('H:i', $time); @endphp
                        <option value="{{ $timeStr }}" {{ $valorHoraFin == $timeStr ? 'selected' : '' }}>
                            {{ $timeStr }}
                        </option>
                    @endfor
                </select>
                <div class="invalid-feedback">Ingrese la hora de fin.</div>
            </div>

            {{-- Botones Cancelar y Guardar --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script para validación  --}}
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
