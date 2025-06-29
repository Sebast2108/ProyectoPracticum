@extends('layouts.master')

@section('title', 'Editar Paciente')

@section('content')

{{-- Contenedor centrado para el formulario --}}
<div class="container form-container">

    {{-- Tarjeta del formulario --}}
    <div class="card shadow-sm form-card narrow">

        {{-- Encabezado con título --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Paciente</h5>
        </div>

        {{-- Mostrar errores de validación si los hay --}}
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
        <form action="{{ route('paciente.update', $paciente) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo: Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                       value="{{ old('nombre', $paciente->nombre) }}" required>
                <div class="invalid-feedback">Ingrese el nombre del paciente.</div>
            </div>

            {{-- Campo: Apellido --}}
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control"
                       value="{{ old('apellido', $paciente->apellido) }}" required>
                <div class="invalid-feedback">Ingrese el apellido del paciente.</div>
            </div>

            {{-- Campo: ID Paciente --}}
            <div class="mb-3">
                <label for="id_paciente" class="form-label">ID Paciente</label>
                <input type="number" id="id_paciente" name="id_paciente" class="form-control"
                       value="{{ old('id_paciente', $paciente->id_paciente) }}" required>
                <div class="invalid-feedback">Ingrese un ID válido.</div>
            </div>

            {{-- Campo: Correo --}}
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $paciente->email) }}" required>
                <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
            </div>

            {{-- Campo: Historial Médico --}}
            <div class="mb-4">
                <label for="historial_medico" class="form-label">Historial Médico</label>
                <input type="number" id="historial_medico" name="historial_medico" class="form-control"
                       value="{{ old('historial_medico', $paciente->historial_medico) }}" required>
                <div class="invalid-feedback">Ingrese el número de historial médico.</div>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('paciente.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script de validación del formulario con Bootstrap --}}
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
