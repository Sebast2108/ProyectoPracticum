@extends ('layouts.master')

@section ('title','Listado de Reportes')

@section ('content')

    <h2> Listado de Reportes </h2>
     <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha de Generacion</th>
                <th>Formato</th>
                <th>Tipo</th>
                <th>Correo</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        //Codigo en php para consultar base de datos de la tabla Reportes.

        </tbody>
     </table>

@endsection