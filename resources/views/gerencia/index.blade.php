@extends ('layouts.master')

@section ('title','Listado de Gerentes')

@section ('content')

    <h2> Listado de Gerentes </h2>
     <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        //Codigo en php para consultar base de datos de la tabla Gerentes.

        </tbody>
     </table>

@endsection