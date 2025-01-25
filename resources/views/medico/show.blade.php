@extends ('layouts.master')

@section ('title','Detalles del Médico')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Detalles del Médico</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID Médico:</strong> {{ $medico->id_medico }}</p>
            <p><strong>Nombre:</strong> {{ $medico->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $medico->apellido }}</p>
            <p><strong>Correo:</strong> {{ $medico->correo }}</p>
            <p><strong>Especialidad:</strong> {{ $medico->especialidad }}</p>
            <a href="{{ route('medico.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
</div>

@endsection
