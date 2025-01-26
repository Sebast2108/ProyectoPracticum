@extends('layouts.master')

@section('title', 'Listado de Estadísticas')

@section('content')
<h1 class="text-center">Lista de Estadísticas</h1>
<a href="{{ route('estadisticas.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nueva Estadística</a>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
        <thead class="thead-light">
            <tr>
                <th class="text-center">Descripción</th>
                <th class="text-center">ID Estadística</th>
                <th class="text-center">Calificación</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estadisticas as $estadistica)
                <tr>
                    <td class="text-center">{{ $estadistica->descripcion }}</td>
                    <td class="text-center">{{ $estadistica->id_estadistica }}</td>
                    <td class="text-center">{{ $estadistica->valor }}</td>
                    <td class="text-center">
                        <a href="{{ route('estadisticas.show', $estadistica->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('estadisticas.edit', $estadistica->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('estadisticas.destroy', $estadistica->id) }}" method="POST" style="display:inline-block;">
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
