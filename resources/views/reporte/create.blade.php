@extends('layouts.master')

@section('title', 'Crear Reporte')

@section('content')
    <h1 class="text-center">Crear Nuevo Reporte</h1>

    <form action="{{ route('reporte.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" name="correo" id="correo" required>
        </div>

        <div class="form-group">
            <label for="fechaGeneracion">Fecha de Generación</label>
            <input type="date" class="form-control" name="fechaGeneracion" id="fechaGeneracion" required>
        </div>

        <div class="form-group">
            <label for="formato">Formato</label>
            <input type="text" class="form-control" name="formato" id="formato" required>
        </div>

        <div class="form-group">
            <label for="idReporte">ID Reporte</label>
            <input type="number" class="form-control" name="idReporte" id="idReporte" required>
        </div>

        <div class="form-group">
            <label for="tipoReporte">Tipo de Reporte</label>
            <input type="text" class="form-control" name="tipoReporte" id="tipoReporte" required>
        </div>

        <button type="submit" class="btn btn-success">Crear Reporte</button>
    </form>
@endsection
