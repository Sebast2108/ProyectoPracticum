@extends('layouts.master')

@section('title', 'Detalle de Estadística')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Detalle de Estadística</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Descripción: {{ $estadistica->descripcion }}</h5>
            <p class="card-text">ID Estadística: {{ $estadistica->id_estadistica }}</p>
            <p class="card-text">Valor: {{ $estadistica->valor }}</p>
            <a href="{{ route('estadisticas.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
