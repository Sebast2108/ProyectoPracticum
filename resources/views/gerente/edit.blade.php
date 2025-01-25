@extends ('layouts.master')

@section ('title','Listado de Gerentes')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Gerente</h1>

    <form action="{{ route('gerente.update', $gerente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $gerente->nombre }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ $gerente->apellido }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="id_gerente" class="form-label">ID Gerente:</label>
            <input type="number" id="id_gerente" name="id_gerente" class="form-control" value="{{ $gerente->id_gerente }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" id="correo" name="correo" class="form-control" value="{{ $gerente->correo }}" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('gerente.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
