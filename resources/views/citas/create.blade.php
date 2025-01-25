@extends('layouts.master')

@section('title', 'Crear Cita')

@section('content')
    <div class="container">
        <h1>Crear nueva cita</h1>
        <form action="{{ route('citas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo_cita">Tipo de Cita</label>
                <input type="text" name="tipo_cita" id="tipo_cita" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_paciente">Paciente</label>
                <select name="id_paciente" id="id_paciente" class="form-control" required>
                    @foreach ($paciente as $p)
                        <option value="{{ $p->id }}">{{ $p->nombre }} {{ $p->apellido }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_medico">Médico</label>
                <select name="id_medico" id="id_medico" class="form-control" required>
                    @foreach ($medico as $m)
                    <option value="{{ $m->id }}">
                            {{ $m->nombre }} {{ $m->apellido }} - {{ $m->especialidad }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Guardar Cita</button>
        </form>
    </div>
@endsection
