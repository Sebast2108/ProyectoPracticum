@extends('layouts.master')

@section('title', 'Historial Médico')

@section('content')
<div class="container mt-4">

    @php
        $user = Auth::user();
    @endphp

    {{-- Encabezado de página y botón de acción --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Historial Médico</h1>
        @if ($user->role !== 'paciente')
            <a href="{{ route('historial.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar nuevo historial
            </a>
        @endif
    </div>

    {{-- Barra de búsqueda --}}
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar historial por médico, especialidad, fecha, diagnóstico...">
    </div>

    {{-- Tabla --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="historialTable" data-sort-dir="asc">
            <thead class="table-dark">
                <tr>
                    <th onclick="sortTable(0)" style="cursor:pointer">Cita <i class="bi bi-arrow-down-up"></i></th>
                    <th onclick="sortTable(1)" style="cursor:pointer">Médico <i class="bi bi-arrow-down-up"></i></th>
                    <th onclick="sortTable(2)" style="cursor:pointer">Especialidad <i class="bi bi-arrow-down-up"></i></th>
                    <th onclick="sortTable(3)" style="cursor:pointer">Fecha <i class="bi bi-arrow-down-up"></i></th>
                    <th>Síntomas</th>
                    <th>Diagnóstico</th>
                    <th>Tratamiento</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($historial as $item)
                    <tr>
                        <td>{{ $item->cita->id ?? 'N/A' }}</td>
                        <td>
                            {{ $item->cita->medico->nombre ?? 'N/A' }} {{ $item->cita->medico->apellido ?? '' }}
                        </td>
                        <td>
                            {{ $item->cita->medico->especialidad->nombre ?? 'N/A' }}
                        </td>
                        <td>
                            {{ isset($item->cita->fecha) ? \Carbon\Carbon::parse($item->cita->fecha)->format('d/m/Y') : 'N/A' }}
                        </td>
                        <td>{{ $item->sintomas ?? '-' }}</td>
                        <td>{{ $item->diagnostico ?? '-' }}</td>
                        <td>{{ $item->tratamientos ?? '-' }}</td>
                        <td>{{ $item->observaciones ?? '-' }}</td>

                        <td>
                            <a href="{{ route('historial.show', $item->id) }}" class="btn btn-info btn-sm" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>

                            @if ($user->role !== 'paciente')
                                <a href="{{ route('historial.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    title="Eliminar"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"
                                    data-historialid="{{ $item->id }}"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No hay registros en el historial médico.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal de eliminación --}}
@if ($user->role !== 'paciente')
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
          ¿Está seguro que desea eliminar este registro del historial médico?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif

{{-- Scripts --}}
<script>
    // Búsqueda en tabla
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#historialTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Ordenar tabla
    function sortTable(colIndex) {
        const table = document.getElementById('historialTable');
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);
        const asc = table.getAttribute('data-sort-dir') !== 'asc';

        rows.sort((a, b) => {
            let aText = a.cells[colIndex].textContent.trim();
            let bText = b.cells[colIndex].textContent.trim();

            if (colIndex === 3) {
                const formatDate = (d) => {
                    const parts = d.split('/');
                    return new Date(parts[2], parts[1] - 1, parts[0]);
                };
                aText = formatDate(aText);
                bText = formatDate(bText);
            }

            return (aText > bText ? 1 : -1) * (asc ? 1 : -1);
        });

        rows.forEach(row => tbody.appendChild(row));
        table.setAttribute('data-sort-dir', asc ? 'asc' : 'desc');
    }

    // Modal eliminar
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    if (confirmDeleteModal) {
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var historialId = button.getAttribute('data-historialid');
            var form = document.getElementById('deleteForm');
            form.action = '/historial/' + historialId;
        });
    }
</script>
@endsection
