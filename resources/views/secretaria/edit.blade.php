@extends('layouts.master')

@section('title', 'Editar Secretaria')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Contenedor centrado con margen superior --}}
    <div class="card shadow-sm">
        {{-- Tarjeta con sombra y presentación compacta --}}
        <div class="card-header bg-primary text-white text-center">
            {{-- Cabecera con estilo --}}
            <h5 class="mb-0">Editar Secretaria</h5>
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

        <form action="{{ route('secretaria.update', $secretaria) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Campo Nombre --}}
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                       value="{{ old('nombre', $secretaria->nombre) }}" required>
                <div class="invalid-feedback">Ingrese el nombre de la secretaria.</div>
            </div>

            {{-- Campo Apellido --}}
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control"
                       value="{{ old('apellido', $secretaria->apellido) }}" required>
                <div class="invalid-feedback">Ingrese el apellido de la secretaria.</div>
            </div>

            {{-- Campo ID Secretaria --}}
            <div class="mb-3">
                <label for="id_secretaria" class="form-label">ID Secretaria</label>
                <input type="number" id="id_secretaria" name="id_secretaria" class="form-control"
                       value="{{ old('id_secretaria', $secretaria->id_secretaria) }}" required>
                <div class="invalid-feedback">Ingrese un ID válido.</div>
            </div>

            {{-- Campo Correo --}}
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $secretaria->email) }}" required>
                <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
            </div>

            {{-- Selección de usuario solo para administradores --}}
            @if(auth()->user()->role === 'administrador')
                <div class="mb-4">
                    <label for="user_id" class="form-label">Usuario (Secretaria)</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Seleccione un usuario</option>
                        @foreach ($usuariosSecretaria as $usuario)
                            <option value="{{ $usuario->id }}"
                                {{ old('user_id', $secretaria->user_id) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} - {{ $usuario->email }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Seleccione un usuario para esta secretaria.</div>
                </div>
            @endif

            {{-- Botones cancelar y guardar --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('secretaria.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

{{-- Script para validación de formulario Bootstrap --}}
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
