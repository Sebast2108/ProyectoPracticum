@extends('layouts.master')

@section('title', 'Crear Cita')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-custom-width">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Crear Nueva Cita</h5>
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

        {{-- Formulario de creación --}}
        <form action="{{ route('citas.store') }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf

            {{-- Selección de médico --}}
            <div class="mb-3">
                <label for="id_medico" class="form-label">Médico:</label>
                <select id="id_medico" name="id_medico" class="form-select" required>
                    <option value="" disabled selected>Seleccione un médico</option>
                    @foreach ($medico as $m)
                        <option value="{{ $m->id }}">
                            {{ $m->nombre }} {{ $m->apellido }} - {{ $m->especialidad->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Por favor, seleccione un médico.</div>
            </div>

            {{-- Mostrar días de la agenda --}}
            <div id="infoAgenda" class="mb-3 text-muted"></div>

            {{-- Fecha de la cita --}}
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la cita</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="{{ old('fecha') }}" min="{{ date('Y-m-d') }}" required>
                <div class="invalid-feedback">Seleccione una fecha válida.</div>
            </div>

            {{-- Hora de la cita --}}
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de la cita</label>
                <select id="hora" name="hora" class="form-select" required>
                    <option value="" disabled selected>Seleccione una hora</option>
                </select>
                <div class="invalid-feedback">Seleccione una hora válida.</div>
            </div>

            {{-- Tipo de cita --}}
            <div class="mb-3">
                <label for="tipo_cita" class="form-label">Tipo de Cita:</label>
                <input type="text" id="tipo_cita" name="tipo_cita" class="form-control" required value="{{ old('tipo_cita') }}">
                <div class="invalid-feedback">Ingrese el tipo de cita.</div>
            </div>

            {{-- Selección de paciente --}}
            <div class="mb-3">
                <label for="id_paciente" class="form-label">Paciente:</label>

                @php $userRole = Auth::user()->role; @endphp

                @if ($userRole === 'paciente')
                    {{-- Mostrar solo el paciente logueado, input deshabilitado y valor oculto para enviar --}}
                    @foreach ($paciente as $p)
                        <input type="hidden" name="id_paciente" value="{{ $p->id }}">
                        <input type="text" class="form-control" value="{{ $p->nombre }} {{ $p->apellido }}" disabled>
                    @endforeach
                @else
                    <select id="id_paciente" name="id_paciente" class="form-select" required>
                        <option value="" disabled selected>Seleccione un paciente</option>
                        @foreach ($paciente as $p)
                            <option value="{{ $p->id }}" {{ old('id_paciente') == $p->id ? 'selected' : '' }}>
                                {{ $p->nombre }} {{ $p->apellido }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Seleccione un paciente.</div>
                @endif
            </div>

            {{-- Estado de la cita según el rol del usuario --}}
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>

                @php
                    $userRole = Auth::user()->role;
                    $estadoActual = old('estado', 'Pendiente');
                    $opcionesEstado = ['Pendiente', 'Confirmada', 'Atendida', 'Cancelada'];
                @endphp

                @if ($userRole === 'paciente')
                    {{-- Mostrar solo el estado Pendiente, ocultar el valor real para envío --}}
                    <input type="hidden" name="estado" value="Pendiente">
                    <input type="text" class="form-control" value="Pendiente" disabled>
                @elseif ($userRole === 'secretaria')
                    <select id="estado" name="estado" class="form-select" required>
                        <option value="Pendiente" selected>Pendiente</option>
                    </select>
                @elseif (in_array($userRole, ['medico', 'administrador']))
                    <select id="estado" name="estado" class="form-select" required>
                        @foreach ($opcionesEstado as $opcion)
                            <option value="{{ $opcion }}" {{ $estadoActual === $opcion ? 'selected' : '' }}>
                                {{ $opcion }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <input type="hidden" name="estado" value="{{ $estadoActual }}">
                    <input type="text" class="form-control" value="{{ $estadoActual }}" disabled>
                @endif

                <div class="invalid-feedback">Ingrese el estado de la cita.</div>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar Cita</button>
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

{{-- jQuery y moment.js --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

{{-- Script para cargar días y horas filtrando ocupadas --}}
<script>
$(document).ready(function () {
    // Cargar los días de la agenda para mostrar info
    function cargarDiasAgenda(medicoId) {
        if (!medicoId) {
            $('#infoAgenda').text('');
            return;
        }

        $.ajax({
            url: `/medicos/${medicoId}/dias-agenda`,
            method: 'GET',
            success: function(data) {
                if (data.dias && data.dias.length > 0) {
                    $('#infoAgenda').text('Días en agenda: ' + data.dias.join(', '));
                } else {
                    $('#infoAgenda').text('No hay días asignados en agenda');
                }
            },
            error: function() {
                $('#infoAgenda').text('Error al cargar días de agenda');
            }
        });
    }

    // Cargar horas disponibles filtrando las ocupadas
    function cargarHorasDisponibles() {
        const medicoId = $('#id_medico').val();
        const fecha = $('#fecha').val();

        const $horaSelect = $('#hora');
        $horaSelect.empty();

        if (medicoId && fecha) {
            $horaSelect.append('<option disabled selected>Cargando...</option>');

            $.ajax({
                url: `/medicos/${medicoId}/agenda`,
                method: 'GET',
                data: { fecha: fecha },
                success: function (data) {
                    $horaSelect.empty().append('<option disabled selected>Seleccione una hora</option>');

                    const inicio = moment(data.hora_inicio, 'HH:mm:ss');
                    const fin = moment(data.hora_fin, 'HH:mm:ss');
                    const horasOcupadas = data.horas_ocupadas || [];

                    while (inicio <= fin) {
                        const hora = inicio.format('HH:mm');
                        if (!horasOcupadas.includes(hora)) {
                            $horaSelect.append(`<option value="${hora}">${hora}</option>`);
                        }
                        inicio.add(15, 'minutes');
                    }

                    if ($horaSelect.children('option').length === 1) { // solo el disabled
                        $horaSelect.empty().append('<option disabled selected>No hay horas disponibles</option>');
                    }
                },
                error: function (xhr) {
                    let mensaje = 'No hay horas disponibles';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        mensaje = xhr.responseJSON.error;
                    }
                    $horaSelect.empty().append(`<option disabled selected>${mensaje}</option>`);
                }
            });
        } else {
            $horaSelect.append('<option disabled selected>Seleccione un médico y una fecha</option>');
        }
    }

    // Al cambiar médico, cargar días y resetear fecha y horas
    $('#id_medico').on('change', function () {
        const medicoId = $(this).val();
        cargarDiasAgenda(medicoId);
        $('#fecha').val('');
        $('#hora').empty().append('<option disabled selected>Seleccione un médico y una fecha</option>');
    });

    // Al cambiar fecha, cargar horas disponibles
    $('#fecha').on('change', cargarHorasDisponibles);
});
</script>
@endsection
