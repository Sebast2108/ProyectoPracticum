@extends('layouts.master')

@section('title', 'Editar Especialidad')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado usando flexbox --}}
    <div class="card shadow-sm">
        {{-- Cabecera con fondo primario y texto blanco --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Especialidad</h5>
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
        <form action="{{ route('especialidad.update', $especialidad->id_especialidad) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                       value="{{ old('nombre', $especialidad->nombre) }}" required>
                <div class="invalid-feedback">Ingrese el nombre de la especialidad.</div>
            </div>

            {{-- Campo Descripción --}}
            <div class="mb-4">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $especialidad->descripcion) }}</textarea>
                <div class="invalid-feedback">Ingrese una descripción para la especialidad.</div>
            </div>

            {{-- Botones Cancelar y Guardar --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('especialidad.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script de validación con Bootstrap --}}
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
