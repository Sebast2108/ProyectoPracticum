@extends('layouts.master')

@section('title', 'Listado de Administradores')

@section('content')
<div class="container mt-4">

    {{-- Encabezado de página y botón de acción --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Administradores</h1>
        <a href="{{ route('administrador.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear nuevo Administrador
        </a>
    </div>

    {{-- Barra de búsqueda para filtrar administradores --}}
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar administradores por nombre, apellido...">
    </div>

    {{-- Tabla responsiva --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="administradoresTable" data-sort-dir="asc">
            <thead class="table-dark">
                <tr>
                    {{-- Encabezados ordenables --}}
                    <th scope="col" style="cursor:pointer" onclick="sortTable(0)">Nombre <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(1)">Apellido <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(2)">ID <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(3)">Correo <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Mostrar cada administrador --}}
                @forelse ($administrador as $adm)
                <tr>
                    <td>{{ $adm->nombre }}</td>
                    <td>{{ $adm->apellido }}</td>
                    <td>{{ $adm->id_administrador }}</td>
                    <td>{{ $adm->email }}</td>
                    <td>
                        {{-- Botones de acción --}}
                        <div class="btn-group" role="group">
                            {{-- Botón: Ver --}}
                            <a href="{{ route('administrador.show', $adm->id) }}" class="btn btn-info btn-sm" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>

                            {{-- Botón: Editar --}}
                            <a href="{{ route('administrador.edit', $adm->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            {{-- Botón: Eliminar con modal --}}
                            <button
                                class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal"
                                data-adminid="{{ $adm->id }}"
                                title="Eliminar"
                            >
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                {{-- Mensaje si no hay administradores --}}
                <tr>
                    <td colspan="5" class="text-center">No hay administradores registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Confirmar Eliminación --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" id="deleteForm">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteLabel">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¿Está seguro que desea eliminar este administrador?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- Scripts comunes para búsqueda, orden y modal --}}
<script>
    // Modal eliminar: cambiar acción del formulario según botón clickeado
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var adminId = button.getAttribute('data-adminid');
        var form = document.getElementById('deleteForm');
        form.action = '/administrador/' + adminId;
    });

    // Filtrado en tabla
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#administradoresTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Ordenar tabla al hacer clic en encabezado
    function sortTable(colIndex) {
        const table = document.getElementById('administradoresTable');
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
</script>
@endsection
