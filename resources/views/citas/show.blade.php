@extends('layouts.master')

@section('title', 'Detalles de la cita')

@section('content')
    <div class="container">
        <h1>Detalles de la cita</h1>
        <ul class="list-group">

            <li class="list-group-item"><strong>Paciente:</strong> {{ $citas->paciente->nombre }} {{ $citas->paciente->apellido }}</li>
            

            <li class="list-group-item"><strong>Médico:</strong> {{ $citas->medico->nombre }} {{ $citas->medico->apellido }}</li>
            
            <li class="list-group-item"><strong>Fecha:</strong> {{ $citas->fecha }}</li>
            <li class="list-group-item"><strong>Hora:</strong> {{ $citas->hora }}</li>
            <li class="list-group-item"><strong>Tipo de cita:</strong> {{ $citas->tipo_citas }}</li>
            <li class="list-group-item"><strong>Estado:</strong> {{ $citas->estado }}</li>
        </ul>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
    </div>
@endsection
