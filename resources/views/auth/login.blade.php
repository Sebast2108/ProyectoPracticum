<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - Hospital Isidro Ayora</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

{{-- Contenedor principal del formulario --}}
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            {{-- Tarjeta principal del formulario de login --}}
            <div class="card shadow login-card">
                <div class="card-body position-relative">

                    {{-- Botón para regresar a la página principal --}}
                    <a class="btn btn-outline-primary btn-sm btn-return" href="{{ url('/') }}">
                        <i class="bi bi-arrow-left"></i> Regresar
                    </a>

                    {{-- Título del formulario con ícono --}}
                    <h3 class="text-center mb-4 login-title">
                        <i class="bi bi-shield-lock-fill me-2"></i>Iniciar Sesión
                    </h3>

                    {{-- Mensaje de error si existen errores de validación --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $errors->first() }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    {{-- Formulario de inicio de sesión --}}
                    <form id="loginForm" class="needs-validation" method="POST" action="{{ route('login.post') }}" novalidate>
                        @csrf

                        {{-- Campo: Correo Electrónico --}}
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Correo electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                <input 
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="usuario"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Por favor, ingresa tu correo electrónico.
                                </div>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo: Contraseña --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input 
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    required>
                                <div class="invalid-feedback">
                                    Por favor, ingresa tu contraseña.
                                </div>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Botón: Enviar formulario --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión
                            </button>
                        </div>
                    </form>

                    {{-- Enlaces para recuperar contraseña y registrarse --}}
                    <div class="mt-4 text-center">
                        <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a><br>
                        <span class="text-muted">¿No tienes cuenta?</span>
                        <a href="#" class="text-decoration-none">Regístrate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script para validación --}}
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
