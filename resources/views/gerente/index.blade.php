@extends ('layouts.master')

@section ('title','Listado de Gerentes')

@section ('content')

<h1 class="text-center">Lista de Gerentes</h1>
    <a href="{{ route('gerente.create') }}" class="btn btn-success d-block mx-auto mb-3">Crear nuevo Gerente</a>
    
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
                @foreach ($gerente as $gerente)
                    <tr>
                        <td class="text-center">{{ $gerente->nombre }}</td>
                        <td class="text-center">{{ $gerente->apellido }}</td>
                        <td class="text-center">{{ $gerente->id_gerente }}</td>
                        <td class="text-center">{{ $gerente->correo }}</td>
                        <td class="text-center">
                            <a href="{{ route('gerente.show', $gerente->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('gerente.edit', $gerente->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('gerente.destroy', $gerente->id) }}" method="POST" style="display:inline-block;">
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