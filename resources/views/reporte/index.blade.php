@extends('layouts.master')

@section('title', 'Listado de Reportes')

@section('content')
    <h1 class="text-center">Lista de Reportes</h1>
    <a href="{{ route('reporte.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nuevo Reporte</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Fecha Generación</th>
                    <th class="text-center">Formato</th>
                    <th class="text-center">ID Reporte</th>
                    <th class="text-center">Tipo Reporte</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reporte as $reporte)
                    <tr>
                        <td class="text-center">{{ $reporte->correo }}</td>
                        <td class="text-center">{{ $reporte->fechaGeneracion }}</td>
                        <td class="text-center">{{ $reporte->formato }}</td>
                        <td class="text-center">{{ $reporte->idReporte }}</td>
                        <td class="text-center">{{ $reporte->tipoReporte }}</td>
                        <td class="text-center">
                            <a href="{{ route('reporte.show', $reporte->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('reporte.edit', $reporte->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('reporte.destroy', $reporte->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
