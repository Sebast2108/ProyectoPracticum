@extends('layouts.master')

@section('title', 'Editar Administrador')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado usando flexbox --}}
    <div class="card shadow-sm">
        
        {{-- Cabecera con fondo primario y texto blanco --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Administrador</h5>
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
        <form action="{{ route('administrador.update', $administrador) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                       value="{{ old('nombre', $administrador->nombre) }}" required>
                <div class="invalid-feedback">Ingrese el nombre del administrador.</div>
            </div>

            {{-- Campo Apellido --}}
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control"
                       value="{{ old('apellido', $administrador->apellido) }}" required>
                <div class="invalid-feedback">Ingrese el apellido del administrador.</div>
            </div>

            {{-- Campo ID Administrador --}}
            <div class="mb-3">
                <label for="id_administrador" class="form-label">ID Administrador</label>
                <input type="number" id="id_administrador" name="id_administrador" class="form-control"
                       value="{{ old('id_administrador', $administrador->id_administrador) }}" required>
                <div class="invalid-feedback">Ingrese un ID válido.</div>
            </div>

            {{-- Campo Correo Electrónico --}}
            <div class="mb-4">
                <label for="email" class="form-label">Correo</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $administrador->email) }}" required>
                <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
            </div>

            {{-- Botones Cancelar y Guardar --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('administrador.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script para validación --}}
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
