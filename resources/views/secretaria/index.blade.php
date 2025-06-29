@extends('layouts.master')

@section('title', 'Listado de Secretarias')

@section('content')
<div class="container mt-4">

    {{-- Contenedor con título y botón para crear nueva secretaria --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Secretarias</h1>
        <a href="{{ route('secretaria.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Nueva Secretaria
        </a>
    </div>

    {{-- Campo de búsqueda para filtrar secretarias --}}
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar secretarias por nombre, apellido...">
    </div>

    {{-- Tabla responsiva que lista las secretarias --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="secretariasTable" data-sort-dir="">
            <thead class="table-dark">
                <tr>
                    {{-- Encabezados con funcionalidad para ordenar --}}
                    <th scope="col" style="cursor:pointer" onclick="sortTable(0)">Nombre <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(1)">Apellido <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(2)">ID Secretaria <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(3)">Correo <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Recorrer la colección de secretarias y mostrar datos --}}
                @forelse ($secretaria as $s)
                    <tr>
                        <td>{{ $s->nombre }}</td>
                        <td>{{ $s->apellido }}</td>
                        <td>{{ $s->id_secretaria }}</td>
                        <td>{{ $s->email }}</td>
                        <td>
                            {{-- Botón para ver detalles --}}
                            <a href="{{ route('secretaria.show', $s->id_secretaria) }}" class="btn btn-info btn-sm" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- Botón para editar --}}
                            <a href="{{ route('secretaria.edit', $s->id_secretaria) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            {{-- Botón confirmación de eliminación --}}
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                title="Eliminar"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal"
                                data-secretariaid="{{ $s->id }}"
                            >
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay secretarias registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Confirmar Eliminación --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteLabel">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¿Está seguro que desea eliminar esta secretaria?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Scripts para búsqueda, ordenamiento y manejo del modal --}}
<script>
    // Filtrar filas de la tabla según texto ingresado en búsqueda
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#secretariasTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Ordenar la tabla por columna al hacer clic en encabezado
    function sortTable(colIndex) {
        const table = document.getElementById('secretariasTable');
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);
        const asc = table.getAttribute('data-sort-dir') !== 'asc';

        rows.sort((a, b) => {
            const aText = a.cells[colIndex].textContent.trim();
            const bText = b.cells[colIndex].textContent.trim();
            return (aText > bText ? 1 : -1) * (asc ? 1 : -1);
        });

        rows.forEach(row => tbody.appendChild(row));
        table.setAttribute('data-sort-dir', asc ? 'asc' : 'desc');
    }

    // Modal eliminar: cambiar acción del formulario según botón clickeado
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var secretariaId = button.getAttribute('data-secretariaid');
        var form = document.getElementById('deleteForm');
        form.action = '/secretaria/' + secretariaId;
    });
</script>
@endsection
