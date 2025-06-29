@extends('layouts.master')

@section('title', 'Crear Nuevo Usuario')

@section('content')

{{-- Contenedor centrado con margen superior --}}
<div class="container form-container">

    {{-- Tarjeta con sombra para formulario --}}
    <div class="card shadow-sm form-card">

        {{-- Encabezado con fondo primario y texto blanco --}}
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Crear Nuevo Usuario</h5>
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

        {{-- Formulario para crear usuario --}}
        <form action="{{ route('users.store') }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf

            {{-- Campo Nombre Completo --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nombre Completo:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                <div class="invalid-feedback">Por favor ingresa el nombre completo.</div>
            </div>

            {{-- Campo Correo Electrónico --}}
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                <div class="invalid-feedback">Por favor ingresa un correo válido.</div>
            </div>

            {{-- Campo Contraseña --}}
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <div class="invalid-feedback">Por favor ingresa una contraseña.</div>
            </div>

            {{-- Campo Confirmar Contraseña --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                <div class="invalid-feedback">Por favor confirma la contraseña.</div>
            </div>

            {{-- Select Rol de Usuario --}}
            <div class="mb-3">
                <label for="role" class="form-label">Rol del Usuario:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Selecciona un rol</option>
                    <option value="paciente" {{ old('role') == 'paciente' ? 'selected' : '' }}>Paciente</option>
                    <option value="medico" {{ old('role') == 'medico' ? 'selected' : '' }}>Médico</option>
                    <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="secretaria" {{ old('role') == 'secretaria' ? 'selected' : '' }}>Secretaria</option>
                    <option value="gerente" {{ old('role') == 'gerente' ? 'selected' : '' }}>Gerente</option>
                </select>
                <div class="invalid-feedback">Por favor selecciona un rol.</div>
            </div>

            {{-- Botones de acción: Cancelar y Guardar --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script para validación de formulario con Bootstrap 5 --}}
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
            }, false);
        });
    })();
</script>

@endsection
