<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center">Iniciar Sesión</h3>
                        <form id="loginForm" class="needs-validation" novalidate>
                            <!-- Campo de Usuario -->
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese su usuario.
                                </div>
                            </div>

                            <!-- Campo de Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese su contraseña.
                                </div>
                            </div>

                            <!-- Botón de Inicio de Sesión -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
                        
                        <!-- Opciones adicionales -->
                        <div class="mt-3 text-center">
                            <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                            <p class="mt-2">¿No tienes cuenta? <a href="#" class="text-decoration-none">Regístrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validación personalizada -->
    <script>
        (function () {
            'use strict';

            // Validación de formulario
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
