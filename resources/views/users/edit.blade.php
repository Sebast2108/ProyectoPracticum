@extends('layouts.master')

@section('title', 'Editar Usuario')

@section('content')

{{-- Contenedor centrado con margen superior --}}
<div class="container form-container">

    {{-- Tarjeta con sombra para formulario --}}
    <div class="card shadow-sm form-card-narrow">

        {{-- Encabezado con fondo primario y texto blanco --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Usuario</h5>
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

        {{-- Formulario para editar usuario --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo Nombre --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $user->name) }}" 
                    class="form-control" 
                    required
                >
                <div class="invalid-feedback">Ingrese el nombre del usuario.</div>
            </div>

            {{-- Campo Correo Electrónico --}}
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email', $user->email) }}" 
                    class="form-control" 
                    required
                >
                <div class="invalid-feedback">Ingrese un correo válido.</div>
            </div>

            {{-- Select Rol --}}
            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select 
                    name="role" 
                    id="role" 
                    class="form-select" 
                    required
                >
                    @foreach (['paciente', 'medico', 'administrador', 'secretaria', 'gerente'] as $rol)
                        <option 
                            value="{{ $rol }}" 
                            {{ old('role', $user->role) === $rol ? 'selected' : '' }}
                        >
                            {{ ucfirst($rol) }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Seleccione un rol válido.</div>
            </div>

            {{-- Campo Nueva Contraseña (opcional) --}}
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña (opcional)</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="form-control" 
                    autocomplete="new-password"
                >
                <small class="text-muted">Dejar en blanco si no desea cambiar la contraseña.</small>
            </div>

            {{-- Campo Confirmar Nueva Contraseña --}}
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="form-control" 
                    autocomplete="new-password"
                >
            </div>

            {{-- Botones Cancelar y Actualizar --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
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
