@extends('layouts.master')

@section('title', 'Editar Reporte')

@section('content')
    <h1 class="text-center">Editar Reporte</h1>

    <form action="{{ route('reporte.update', $reporte->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" value="{{ $reporte->correo }}" required>
        </div>

        <div class="form-group">
            <label for="fechaGeneracion">Fecha de Generación</label>
            <input type="date" class="form-control" name="fechaGeneracion" id="fechaGeneracion" value="{{ $reporte->fechaGeneracion }}" required>
        </div>

        <div class="form-group">
            <label for="formato">Formato</label>
            <input type="text" class="form-control" name="formato" id="formato" value="{{ $reporte->formato }}" required>
        </div>

        <div class="form-group">
            <label for="idReporte">ID Reporte</label>
            <input type="number" class="form-control" name="idReporte" id="idReporte" value="{{ $reporte->idReporte }}" required>
        </div>

        <div class="form-group">
            <label for="tipoReporte">Tipo de Reporte</label>
            <input type="text" class="form-control" name="tipoReporte" id="tipoReporte" value="{{ $reporte->tipoReporte }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Reporte</button>
    </form>
@endsection
