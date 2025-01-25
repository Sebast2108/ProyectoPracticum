@extends ('layouts.master')

@section ('title','Detalles de Administradores')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Detalles del Administrador</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID administrador:</strong> {{ $administrador->id_administrador }}</p>
            <p><strong>Nombre:</strong> {{ $administrador->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $administrador->apellido }}</p>
            <p><strong>Correo:</strong> {{ $administrador->correo }}</p>
            <a href="{{ route('administrador.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
</div>

@endsection
