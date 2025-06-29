@extends('layouts.master')

@section('title', 'Editar Gerente')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado con tarjeta --}}
    <div class="card shadow-sm">
        {{-- Cabecera de la tarjeta --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Gerente</h5>
        </div>

        {{-- Mensajes de error de validación --}}
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
        <form action="{{ route('gerente.update', $gerente) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                       value="{{ old('nombre', $gerente->nombre) }}" required>
                <div class="invalid-feedback">Ingrese el nombre del gerente.</div>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" id="apellido" name="apellido" class="form-control"
                       value="{{ old('apellido', $gerente->apellido) }}" required>
                <div class="invalid-feedback">Ingrese el apellido del gerente.</div>
            </div>

            <div class="mb-3">
                <label for="id_gerente" class="form-label">ID Gerente:</label>
                <input type="number" id="id_gerente" name="id_gerente" class="form-control"
                       value="{{ old('id_gerente', $gerente->id_gerente) }}" required>
                <div class="invalid-feedback">Ingrese un ID válido.</div>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $gerente->email) }}" required>
                <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('gerente.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
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
