@extends('layouts.master')

@section('title', 'Editar Médico')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado con margen superior --}}
    <div class="card shadow-sm">
        {{-- Tarjeta con sombra para presentación compacta --}}
        <div class="card-header bg-primary text-white text-center">
            {{-- Cabecera con título centrado --}}
            <h5 class="mb-0">Editar Médico</h5>
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

        <form action="{{ route('medico.update', $medico) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                       value="{{ old('nombre', $medico->nombre) }}" required>
                <div class="invalid-feedback">Ingrese el nombre del médico.</div>
            </div>

            {{-- Campo Apellido --}}
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control"
                       value="{{ old('apellido', $medico->apellido) }}" required>
                <div class="invalid-feedback">Ingrese el apellido del médico.</div>
            </div>

            {{-- Campo ID Médico --}}
            <div class="mb-3">
                <label for="id_medico" class="form-label">ID Médico</label>
                <input type="number" id="id_medico" name="id_medico" class="form-control"
                       value="{{ old('id_medico', $medico->id_medico) }}" required>
                <div class="invalid-feedback">Ingrese un ID válido.</div>
            </div>

            {{-- Campo Correo --}}
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $medico->email) }}" required>
                <div class="invalid-feedback">Ingrese un correo válido.</div>
            </div>

            {{-- Campo Especialidad --}}
            <div class="mb-4">
                <label for="id_especialidad" class="form-label">Especialidad</label>
                <select id="id_especialidad" name="id_especialidad" class="form-select" required>
                    <option value="" disabled>Seleccione una especialidad</option>
                    @foreach ($especialidad as $esp)
                        <option value="{{ $esp->id_especialidad }}" 
                            {{ old('id_especialidad', $medico->id_especialidad) == $esp->id_especialidad ? 'selected' : '' }}>
                            {{ $esp->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Ingrese la especialidad del médico.</div>
            </div>

            {{-- Botones Cancelar y Guardar --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('medico.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script para validación Bootstrap --}}
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
