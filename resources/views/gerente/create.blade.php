@extends('layouts.master')

@section('title', 'Crear Nuevo Gerente')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-custom-width">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Crear Nuevo Gerente</h5>
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

        {{-- Formulario --}}
        <form action="{{ route('gerente.store') }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                <div class="invalid-feedback">Por favor ingrese el nombre del gerente.</div>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
                <div class="invalid-feedback">Por favor ingrese el apellido del gerente.</div>
            </div>

            <div class="mb-3">
                <label for="id_gerente" class="form-label">ID Gerente</label>
                <input type="number" id="id_gerente" name="id_gerente" class="form-control" value="{{ old('id_gerente') }}" required>
                <div class="invalid-feedback">Por favor ingrese un ID válido.</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                <div class="invalid-feedback">Por favor ingrese un correo electrónico válido.</div>
            </div>

            {{-- Asignar usuario al gerente --}}
            @if(in_array(auth()->user()->role, ['administrador', 'secretaria']))
                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuario (Gerente)</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        <option value="">Seleccione un usuario</option>
                        @foreach($usuariosGerente as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }} - {{ $usuario->email }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor seleccione un usuario gerente.</div>
                </div>
            @endif

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('gerente.index') }}" class="btn btn-secondary">Cancelar</a>
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
