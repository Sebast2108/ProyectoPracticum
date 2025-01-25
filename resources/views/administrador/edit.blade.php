@extends ('layouts.master')

@section ('title','Listado de administradors')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Administrador</h1>

    <form action="{{ route('administrador.update', $administrador) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $administrador->nombre }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $administrador->apellido }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="id_administrador" class="form-label">ID Administrador:</label>
            <input type="number" id="id_administrador" name="id_administrador" class="form-control" value="{{ $administrador->id_administrador }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{ $administrador->correo }}" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('administrador.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
