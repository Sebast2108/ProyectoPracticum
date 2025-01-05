@extends ('layouts.master')

@section ('title','Listado de Doctores')

@section ('content')

    <h2> Listado de Doctores </h2>
     <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Specialty</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        //Codigo en php para consultar base de datos de la tabla Doctores.

        </tbody>
     </table>

@endsection