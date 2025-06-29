@extends('layouts.master')

@section('title', 'Detalles de la Agenda')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    {{-- Tarjeta con sombra y ancho controlado por CSS unificado --}}
    <div class="card shadow-sm card-detalles">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">Detalles de la Agenda</h5>
        </div>
        <ul class="list-group list-group-flush text-center">
            <li class="list-group-item">
                <strong>Días de atención:</strong>
                {{ implode(', ', $agenda->dias) }}
            </li>
            <li class="list-group-item">
                <strong>Hora de inicio:</strong> {{ $agenda->hora_inicio }}
            </li>
            <li class="list-group-item">
                <strong>Hora de fin:</strong> {{ $agenda->hora_fin }}
            </li>
        </ul>
        <div class="card-body text-center">
            <a href="{{ route('agenda.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
</div>
@endsection
