@extends ('layouts.master')

@section ('title','Editar Paciente')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Paciente</h1>

    <form action="{{ route('paciente.update', $paciente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $paciente->nombre }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $paciente->apellido }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="id_paciente" class="form-label">ID Paciente:</label>
            <input type="number" id="id_paciente" name="id_paciente" class="form-control" value="{{ $paciente->id_paciente }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{ $paciente->correo }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="historial_medico" class="form-label">Historial Médico:</label>
            <input type="number" id="historial_medico" name="historial_medico" class="form-control" value="{{ $paciente->historial_medico }}" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('paciente.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
