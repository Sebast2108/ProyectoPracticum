@extends ('layouts.master')

@section ('title','Listado de Pacientes')

@section ('content')

    <h2> Listado de Pacientes </h2>
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

        //Codigo en php para consultar base de datos de la tabla pacientes.

        </tbody>
     </table>

@endsection