@extends ('layouts.master')

@section ('title','Detalles del Paciente')

@section ('content')

<div class="container mt-4">
    <h1 class="text-center mb-4">Detalles del Paciente</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $paciente->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $paciente->apellido }}</p>
            <p><strong>ID Paciente:</strong> {{ $paciente->id_paciente }}</p>
            <p><strong>Correo:</strong> {{ $paciente->correo }}</p>
            <p><strong>Historial Médico:</strong> {{ $paciente->historial_medico }}</p>
            <a href="{{ route('paciente.index') }}" class="btn btn-primary">Volver a la lista</a>
        </div>
    </div>
</div>

@endsection
