@extends ('layouts.master')

@section ('title','Editar Médico')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Médico</h1>

    <form action="{{ route('medico.update', $medico) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $medico->nombre }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $medico->apellido }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="id_medico" class="form-label">ID Médico:</label>
            <input type="number" id="id_medico" name="id_medico" class="form-control" value="{{ $medico->id_medico }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{ $medico->correo }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="especialidad" class="form-label">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" class="form-control" value="{{ $medico->especialidad }}" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('medico.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
