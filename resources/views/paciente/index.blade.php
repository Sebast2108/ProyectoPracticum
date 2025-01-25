@extends ('layouts.master')

@section ('title','Listado de Pacientes')

@section ('content')

<h1 class="text-center">Lista de Pacientes</h1>
    <a href="{{ route('paciente.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nuevo paciente</a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Historial Médico</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paciente as $paciente)
                    <tr>
                        <td class="text-center">{{ $paciente->nombre }}</td>
                        <td class="text-center">{{ $paciente->apellido }}</td>
                        <td class="text-center">{{ $paciente->id_paciente }}</td>
                        <td class="text-center">{{ $paciente->correo }}</td>
                        <td class="text-center">{{ $paciente->historial_medico }}</td>
                        <td class="text-center">
                            <a href="{{ route('paciente.show', $paciente->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('paciente.edit', $paciente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST" style="display:inline-block;">
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
