@extends ('layouts.master')

@section ('title','Detalles de Gerentes')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Detalles del Gerente</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID Gerente:</strong> {{ $gerente->id_gerente }}</p>
            <p><strong>Nombre:</strong> {{ $gerente->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $gerente->apellido }}</p>
            <p><strong>Correo:</strong> {{ $gerente->correo }}</p>
            <a href="{{ route('gerente.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
</div>

@endsection
