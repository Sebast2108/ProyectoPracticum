<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programación de Citas Médicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Programación de Citas Médicas</h2>
        <form class="mt-4">
            <!-- Campo de Selección de Médico -->
            <div class="mb-3">
                <label for="medico" class="form-label">Seleccione un Médico</label>
                <select class="form-select" id="medico" name="medico" required>
                    <option value="" selected disabled>Seleccione un médico...</option>
                    <option value="1">Dr. Juan Pérez - Cardiología</option>
                    <option value="2">Dra. María López - Pediatría</option>
                    <option value="3">Dr. Carlos Sánchez - Dermatología</option>
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un médico.
                </div>
            </div>

            <!-- Campo de Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la Cita</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
                <div class="invalid-feedback">
                    Por favor, seleccione una fecha válida.
                </div>
            </div>

            <!-- Campo de Hora -->
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de la Cita</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
                <div class="invalid-feedback">
                    Por favor, seleccione una hora válida.
                </div>
            </div>

            <!-- Información del Paciente -->
            <h5 class="mt-4">Información del Paciente</h5>
            <div class="mb-3">
                <label for="nombrePaciente" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" required>
                <div class="invalid-feedback">
                    Por favor, ingrese el nombre completo del paciente.
                </div>
            </div>

            <div class="mb-3">
                <label for="telefonoPaciente" class="form-label">Teléfono de Contacto</label>
                <input type="tel" class="form-control" id="telefonoPaciente" name="telefonoPaciente" pattern="\d{10}" required>
                <div class="invalid-feedback">
                    Por favor, ingrese un número de teléfono válido (10 dígitos).
                </div>
            </div>

            <!-- Botón de Envío -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Programar Cita</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Validación personalizada -->
    <script>
        (function () {
            'use strict';

            const forms = document.querySelectorAll('form');

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
