@extends('layouts.master')

@section('title', 'Detalles de la cita')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Tarjeta con sombra y ancho controlado desde CSS --}}
    <div class="card shadow-sm card-detalles">
        <div class="card-header bg-primary text-white text-center">
            {{-- Título centrado con fondo primario --}}
            <h5 class="mb-0">Información de la cita</h5>
        </div>
        <ul class="list-group list-group-flush text-center">
            {{-- Detalles de la cita --}}
            <li class="list-group-item">
                <strong>Paciente:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}
            </li>
            <li class="list-group-item">
                <strong>Médico:</strong> {{ $cita->medico->nombre }} {{ $cita->medico->apellido }}
            </li>
            <li class="list-group-item">
                <strong>Tipo de cita:</strong> {{ ucfirst($cita->tipo_cita) }}
            </li>
            <li class="list-group-item">
                <strong>Estado:</strong> 
                {{-- Mostrar estado con colores según el tipo --}}
                @if($cita->estado == 'confirmada')
                    <span class="badge bg-success">{{ ucfirst($cita->estado) }}</span>
                @elseif($cita->estado == 'pendiente')
                    <span class="badge bg-warning text-dark">{{ ucfirst($cita->estado) }}</span>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($cita->estado) }}</span>
                @endif
            </li>
        </ul>
        <div class="card-body text-center">
            <a href="{{ route('citas.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
