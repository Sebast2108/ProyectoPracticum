@extends('layouts.master')

@section('title', 'Ver Reporte')

@section('content')
    <h1 class="text-center">Detalles del Reporte</h1>

    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" class="form-control" value="{{ $reporte->correo }}" readonly>
    </div>

    <div class="form-group">
        <label for="fechaGeneracion">Fecha de Generación</label>
        <input type="date" class="form-control" value="{{ $reporte->fechaGeneracion }}" readonly>
    </div>

    <div class="form-group">
        <label for="formato">Formato</label>
        <input type="text" class="form-control" value="{{ $reporte->formato }}" readonly>
    </div>

    <div class="form-group">
        <label for="idReporte">ID Reporte</label>
        <input type="number" class="form-control" value="{{ $reporte->idReporte }}" readonly>
    </div>

    <div class="form-group">
        <label for="tipoReporte">Tipo de Reporte</label>
        <input type="text" class="form-control" value="{{ $reporte->tipoReporte }}" readonly>
    </div>
@endsection
