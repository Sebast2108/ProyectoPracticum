<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Formulario de Registro</h2>
        <form id="registroForm" class="needs-validation" novalidate>
            <!-- Campo de Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">
                    Por favor, ingrese su nombre completo.
                </div>
            </div>

            <!-- Campo de Identificación-->
            <div class="mb-3">
                <label for="dni" class="form-label">Identificación</label>
                <input type="text" class="form-control" id="dni" name="dni" pattern="\d+" required>
                <div class="invalid-feedback">
                    Por favor, ingrese una Identificación válida (solo números).
                </div>
            </div>

            <!-- Campo de Fecha de Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                <div class="invalid-feedback">
                    Por favor, seleccione su fecha de nacimiento.
                </div>
            </div>

            <!-- Botón de Envío -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validación personalizada -->
    <script>
        (function () {
            'use strict';

            // Obtener el formulario y aplicar validación
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
