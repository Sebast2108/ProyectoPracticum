@extends ('layouts.master')

@section ('title','Listado de Médicos')

@section ('content')

<h1 class="text-center">Lista de Médicos</h1>
    <a href="{{ route('medico.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nuevo médico</a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Especialidad</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medico as $medico)
                    <tr>
                        <td class="text-center">{{ $medico->nombre }}</td>
                        <td class="text-center">{{ $medico->apellido }}</td>
                        <td class="text-center">{{ $medico->id_medico }}</td>
                        <td class="text-center">{{ $medico->correo }}</td>
                        <td class="text-center">{{ $medico->especialidad }}</td>
                        <td class="text-center">
                            <a href="{{ route('medico.show', $medico->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('medico.edit', $medico->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('medico.destroy', $medico->id) }}" method="POST" style="display:inline-block;">
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