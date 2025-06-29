@extends('layouts.master')

@section('title', 'Editar Cita')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm card-custom-width" style="max-width: 700px;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Editar Cita</h5>
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

        @php
            $userRole = Auth::user()->role;
            $soloLectura = ($userRole === 'medico');
            $horaFormateada = \Carbon\Carbon::parse($cita->hora)->format('H:i');
            $estadoActual = old('estado', $cita->estado);
            $opcionesEstado = ['Pendiente', 'Confirmada', 'Atendida', 'Cancelada'];
        @endphp

        <form action="{{ route('citas.update', $cita->id) }}" method="POST" class="needs-validation p-3" novalidate>
            @csrf
            @method('PUT')

            {{-- Médico --}}
            <div class="mb-3">
                <label for="id_medico" class="form-label">Médico:</label>
                @if ($soloLectura)
                    {{-- Mostrar médico deshabilitado y enviar campo oculto --}}
                    @foreach ($medico as $m)
                        @if ($m->id == $cita->id_medico)
                            <input type="hidden" name="id_medico" value="{{ $m->id }}">
                            <input type="text" class="form-control" value="{{ $m->nombre }} {{ $m->apellido }} - {{ $m->especialidad->nombre }}" disabled>
                        @endif
                    @endforeach
                @else
                    <select id="id_medico" name="id_medico" class="form-select" required>
                        <option value="" disabled>Seleccione un médico</option>
                        @foreach ($medico as $m)
                            <option value="{{ $m->id }}" {{ old('id_medico', $cita->id_medico) == $m->id ? 'selected' : '' }}>
                                {{ $m->nombre }} {{ $m->apellido }} - {{ $m->especialidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un médico.</div>
                @endif
            </div>

            {{-- Mostrar días de la agenda --}}
            <div id="infoAgenda" class="mb-3 text-muted"></div>

            {{-- Fecha --}}
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la cita</label>
                @if ($soloLectura)
                    <input type="hidden" name="fecha" value="{{ old('fecha', $cita->fecha) }}">
                    <input type="date" id="fecha" class="form-control" value="{{ old('fecha', $cita->fecha) }}" disabled>
                @else
                    <input type="date" id="fecha" name="fecha" class="form-control"
                        value="{{ old('fecha', $cita->fecha) }}" min="{{ date('Y-m-d') }}" required>
                    <div class="invalid-feedback">Seleccione una fecha válida.</div>
                @endif
            </div>

            {{-- Hora --}}
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de la cita</label>
                @if ($soloLectura)
                    <select id="hora" name="hora" class="form-select" disabled>
                        <option value="{{ old('hora', $horaFormateada) }}" selected>{{ old('hora', $horaFormateada) }}</option>
                    </select>
                    <input type="hidden" name="hora" value="{{ old('hora', $horaFormateada) }}">
                @else
                    <select id="hora" name="hora" class="form-select" required>
                        <option value="" disabled selected>Seleccione una hora</option>
                        {{-- JS cargará opciones --}}
                    </select>
                    <div class="invalid-feedback">Seleccione una hora válida.</div>
                @endif
            </div>

            {{-- Tipo de cita --}}
            <div class="mb-3">
                <label for="tipo_cita" class="form-label">Tipo de Cita:</label>
                @if ($soloLectura)
                    <input type="hidden" name="tipo_cita" value="{{ old('tipo_cita', $cita->tipo_cita) }}">
                    <input type="text" class="form-control" value="{{ old('tipo_cita', $cita->tipo_cita) }}" disabled>
                @else
                    <input type="text" id="tipo_cita" name="tipo_cita" class="form-control"
                        required value="{{ old('tipo_cita', $cita->tipo_cita) }}">
                    <div class="invalid-feedback">Ingrese el tipo de cita.</div>
                @endif
            </div>

            {{-- Paciente --}}
            <div class="mb-3">
                <label for="id_paciente" class="form-label">Paciente:</label>
                @if ($soloLectura)
                    @foreach ($paciente as $p)
                        @if ($p->id == $cita->id_paciente)
                            <input type="hidden" name="id_paciente" value="{{ $p->id }}">
                            <input type="text" class="form-control" value="{{ $p->nombre }} {{ $p->apellido }}" disabled>
                        @endif
                    @endforeach
                @elseif ($userRole === 'paciente')
                    @foreach ($paciente as $p)
                        @if ($p->id == $cita->id_paciente)
                            <input type="hidden" name="id_paciente" value="{{ $p->id }}">
                            <input type="text" class="form-control" value="{{ $p->nombre }} {{ $p->apellido }}" disabled>
                        @endif
                    @endforeach
                @else
                    <select id="id_paciente" name="id_paciente" class="form-select" required>
                        <option value="" disabled>Seleccione un paciente</option>
                        @foreach ($paciente as $p)
                            <option value="{{ $p->id }}" {{ old('id_paciente', $cita->id_paciente) == $p->id ? 'selected' : '' }}>
                                {{ $p->nombre }} {{ $p->apellido }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Seleccione un paciente.</div>
                @endif
            </div>

            {{-- Estado --}}
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                @if ($userRole === 'paciente')
                    <input type="hidden" name="estado" value="{{ $estadoActual }}">
                    <input type="text" class="form-control" value="{{ $estadoActual }}" disabled>
                @elseif ($userRole === 'secretaria')
                    <select id="estado" name="estado" class="form-select" required>
                        <option value="Pendiente" {{ $estadoActual === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
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

            {{-- Botones --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Guardar Cita</button>
            </div>
        </form>
    </div>
</div>

{{-- Validación --}}
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

                    if ($horaSelect.children('option').length === 1) {
                        $horaSelect.empty().append('<option disabled selected>No hay horas disponibles</option>');
                    }

                    // Seleccionar la hora actual de la cita si está disponible
                    const horaCita = "{{ old('hora', $horaFormateada) }}";
                    if (horaCita && !horasOcupadas.includes(horaCita)) {
                        $horaSelect.val(horaCita);
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

    // Inicializar
    const medicoInicial = $('#id_medico').val();
    if (medicoInicial) {
        cargarDiasAgenda(medicoInicial);
    }
    const fechaInicial = $('#fecha').val();
    if (medicoInicial && fechaInicial) {
        cargarHorasDisponibles();
    }

    // Eventos
    $('#id_medico').on('change', function () {
        const medicoId = $(this).val();
        cargarDiasAgenda(medicoId);
        $('#fecha').val('');
        $('#hora').empty().append('<option disabled selected>Seleccione un médico y una fecha</option>');
    });

    $('#fecha').on('change', cargarHorasDisponibles);
});
</script>
@endsection
