@extends('layouts.master')

@section('title', 'Listado de Historiales Médicos')

@section('content')
<h1 class="text-center">Lista de Historiales Médicos</h1>
<a href="{{ route('historial.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nuevo Historial Médico</a>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
        <thead class="thead-light">
            <tr>
                <th class="text-center">Alergias</th>
                <th class="text-center">Enfermedades Previas</th>
                <th class="text-center">ID Historial</th>
                <th class="text-center">Tratamientos</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historial as $historial)
                <tr>
                    <td class="text-center">{{ $historial->alergias }}</td>
                    <td class="text-center">{{ $historial->enfermedades_previas }}</td>
                    <td class="text-center">{{ $historial->id_historial }}</td>
                    <td class="text-center">{{ $historial->tratamientos }}</td>
                    <td class="text-center">
                        <a href="{{ route('historial.show', $historial->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('historial.edit', $historial->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('historial.destroy', $historial->id) }}" method="POST" style="display:inline-block;">
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
