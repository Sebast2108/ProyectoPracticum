@extends ('layouts.master')

@section ('title','Listado de Administradores')

@section ('content')

<h1 class="text-center">Lista de Administradores</h1>
    <a href="{{ route('administrador.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nuevo Administrador</a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mx-auto" style="width: 80%;">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Correo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($administrador as $administrador)
                    <tr>
                        <td class="text-center">{{ $administrador->nombre }}</td>
                        <td class="text-center">{{ $administrador->apellido }}</td>
                        <td class="text-center">{{ $administrador->id_administrador }}</td>
                        <td class="text-center">{{ $administrador->correo }}</td>
                        <td class="text-center">
                            <a href="{{ route('administrador.show', $administrador->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('administrador.edit', $administrador->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('administrador.destroy', $administrador->id) }}" method="POST" style="display:inline-block;">
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