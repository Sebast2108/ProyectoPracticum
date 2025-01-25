@extends('layouts.master')

@section('title', 'Editar citas')

@section('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Editar citas</h1>

    <form action="{{ route('citas.update', $citas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <input type="text" id="estado" name="estado" class="form-control" value="{{ $citas->estado }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $citas->fecha }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="hora" class="form-label">Hora:</label>
            <input type="time" id="hora" name="hora" class="form-control" value="{{ $citas->hora }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="tipo_citas" class="form-label">Tipo de citas:</label>
            <input type="text" id="tipo_citas" name="tipo_citas" class="form-control" value="{{ $citas->tipo_citas }}" required>
        </div>


        <div class="form-group mb-3">
            <label for="id_paciente" class="form-label">Paciente:</label>
            <select id="id_paciente" name="id_paciente" class="form-control" required>
                @foreach($paciente as $paciente)
                    <option value="{{ $paciente->id }}" 
                            {{ $paciente->id == $citas->id_paciente ? 'selected' : '' }}>
                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="form-group mb-3">
            <label for="id_medico" class="form-label">Médico:</label>
            <select id="id_medico" name="id_medico" class="form-control" required>
                @foreach($medico as $medico)
                    <option value="{{ $medico->id }}" 
                            {{ $medico->id == $citas->id_medico ? 'selected' : '' }}>
                        {{ $medico->nombre }} {{ $medico->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="id_historial" class="form-label">ID Historial:</label>
            <input type="number" id="id_historial" name="id_historial" class="form-control" value="{{ $citas->id_historial }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection
