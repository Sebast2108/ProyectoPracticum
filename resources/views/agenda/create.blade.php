@extends('layouts.master')

@section('title', 'Crear Nueva Agenda')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-custom-width">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Crear Nueva Agenda</h5>
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
        <form action="{{ route('agenda.store') }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf

            {{-- Días de atención --}}
            <div class="mb-3">
                <label class="form-label">Días de Atención</label>
                @php
                    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                @endphp
                <div class="d-flex flex-wrap gap-2">
                    @foreach($dias as $dia)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="dia_{{ $dia }}" name="dias[]" value="{{ $dia }}"
                                {{ (is_array(old('dias')) && in_array($dia, old('dias'))) ? 'checked' : '' }}>
                            <label class="form-check-label" for="dia_{{ $dia }}">{{ $dia }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-text">Seleccione uno o más días.</div>
            </div>

            {{-- Hora de inicio --}}
            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de inicio</label>
                <select id="hora_inicio" name="hora_inicio" class="form-select" required>
                    <option value="" disabled selected>Seleccione hora de inicio</option>
                    @php
                        $start = strtotime('08:00');
                        $end = strtotime('18:00');
                        $interval = 15 * 60;
                    @endphp
                    @for ($time = $start; $time <= $end; $time += $interval)
                        @php $timeStr = date('H:i', $time); @endphp
                        <option value="{{ $timeStr }}" {{ old('hora_inicio') == $timeStr ? 'selected' : '' }}>
                            {{ $timeStr }}
                        </option>
                    @endfor
                </select>
                <div class="invalid-feedback">Ingrese la hora de inicio.</div>
            </div>

            {{-- Hora de fin --}}
            <div class="mb-3">
                <label for="hora_fin" class="form-label">Hora de fin</label>
                <select id="hora_fin" name="hora_fin" class="form-select" required>
                    <option value="" disabled selected>Seleccione hora de fin</option>
                    @php
                        $start = strtotime('08:00');
                        $end = strtotime('18:00');
                        $interval = 15 * 60;
                    @endphp
                    @for ($time = $start; $time <= $end; $time += $interval)
                        @php $timeStr = date('H:i', $time); @endphp
                        <option value="{{ $timeStr }}" {{ old('hora_fin') == $timeStr ? 'selected' : '' }}>
                            {{ $timeStr }}
                        </option>
                    @endfor
                </select>
                <div class="invalid-feedback">Ingrese la hora de fin.</div>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
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
