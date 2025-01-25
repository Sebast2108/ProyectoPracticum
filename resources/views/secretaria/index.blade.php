@extends('layouts.master')

@section('title', 'Listado de Secretarias')

@section('content')

<h1 class="text-center">Lista de Secretarias</h1>
<a href="{{ route('secretaria.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear Nueva Secretaria</a>

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
        <thead class="thead-light">
            <tr>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellido</th>
                <th class="text-center">ID Secretaria</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($secretaria as $secretaria)
                <tr>
                    <td class="text-center">{{ $secretaria->nombre }}</td>
                    <td class="text-center">{{ $secretaria->apellido }}</td>
                    <td class="text-center">{{ $secretaria->id_secretaria }}</td>
                    <td class="text-center">{{ $secretaria->correo }}</td>
                    <td class="text-center">
                        <a href="{{ route('secretaria.show', $secretaria->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('secretaria.edit', $secretaria->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('secretaria.destroy', $secretaria->id) }}" method="POST" style="display:inline-block;">
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
