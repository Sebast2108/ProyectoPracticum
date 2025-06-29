@extends('layouts.master')

@section('title', 'Crear Nuevo Paciente')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-custom-width">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Crear Nuevo Paciente</h5>
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

        <form action="{{ route('paciente.store') }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                <div class="invalid-feedback">Por favor ingrese el nombre.</div>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
                <div class="invalid-feedback">Por favor ingrese el apellido.</div>
            </div>

            <div class="mb-3">
                <label for="id_paciente" class="form-label">ID del Paciente</label>
                <input type="number" id="id_paciente" name="id_paciente" class="form-control" value="{{ old('id_paciente') }}" required>
                <div class="invalid-feedback">Por favor ingrese el ID del paciente.</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                <div class="invalid-feedback">Por favor ingrese un correo válido.</div>
            </div>

            <div class="mb-3">
                <label for="historial_medico" class="form-label">N.º de Historial Médico</label>
                <input type="number" id="historial_medico" name="historial_medico" class="form-control" value="{{ old('historial_medico') }}" required>
                <div class="invalid-feedback">Por favor ingrese el historial médico.</div>
            </div>

            @if(in_array(auth()->user()->role, ['administrador', 'secretaria']))
                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario (Paciente)</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Seleccione un paciente</option>
                        @foreach($usuariosPaciente as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} - {{ $usuario->email }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor seleccione un usuario paciente.</div>
                </div>
            @endif

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('paciente.index') }}" class="btn btn-secondary">Cancelar</a>
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
