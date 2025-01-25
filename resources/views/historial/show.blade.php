@extends('layouts.master')

@section('title', 'Detalle del Historial Médico')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Detalle del Historial Médico</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Alergias: {{ $historial->alergias }}</h5>
            <p class="card-text">Enfermedades Previas: {{ $historial->enfermedades_previas }}</p>
            <p class="card-text">ID Historial: {{ $historial->id_historial }}</p>
            <p class="card-text">Tratamientos: {{ $historial->tratamientos }}</p>
            <a href="{{ route('historial.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
