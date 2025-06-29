@extends('layouts.master')

@section('title', 'Listado de Agendas Médicas')

@section('content')
<div class="container mt-4">

    {{-- Encabezado de página y botón de acción --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Agendas Médicas</h1>
        <a href="{{ route('agenda.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear nueva agenda
        </a>
    </div>

    {{-- Barra de búsqueda para filtrar agendas --}}
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar agendas por día o horario...">
    </div>

    {{-- Tabla responsiva --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="agendaTable" data-sort-dir="asc">
            <thead class="table-dark">
                <tr>
                    {{-- Encabezados ordenables --}}
                    <th scope="col" style="cursor:pointer" onclick="sortTable(0)">ID Agenda <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(1)">Días <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(2)">Hora Inicio <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(3)">Hora Fin <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Mostrar cada agenda --}}
                @forelse ($agenda as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ implode(', ', $a->dias) }}</td>
                    <td>{{ $a->hora_inicio }}</td>
                    <td>{{ $a->hora_fin }}</td>
                    <td>
                        {{-- Botón: Ver --}}
                        <a href="{{ route('agenda.show', $a->id) }}" class="btn btn-info btn-sm" title="Ver">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Botón: Editar --}}
                        <a href="{{ route('agenda.edit', $a->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        {{-- Botón: Eliminar con modal --}}
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            title="Eliminar"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal"
                            data-agendaid="{{ $a->id }}"
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No hay agendas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Confirmar Eliminación --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="deleteForm" method="POST" action="">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteLabel">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¿Está seguro que desea eliminar esta agenda médica?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Scripts comunes para búsqueda, orden y modal --}}
<script>
    // Filtrado en tabla
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#agendaTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Ordenar tabla al hacer clic en encabezado
    function sortTable(colIndex) {
        const table = document.getElementById('agendaTable');
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
        var agendaId = button.getAttribute('data-agendaid');
        var form = document.getElementById('deleteForm');
        form.action = '/agenda/' + agendaId;
    });
</script>
@endsection
