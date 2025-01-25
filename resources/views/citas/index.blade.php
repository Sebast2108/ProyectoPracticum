@extends('layouts.master')

@section('title', 'Citas Medicas')

@section('content')
    <div class="container">
        <h1>Citas</h1>
        <a href="{{ route('citas.create') }}" class="btn btn-primary">Crear nueva cita</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo de Cita</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>

                        <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>

                        <td>{{ $cita->medico->nombre }} {{ $cita->medico->apellido }}</td>

                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>{{ $cita->tipo_cita }}</td>
                        <td>{{ $cita->estado }}</td>
                        <td>
                            <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
