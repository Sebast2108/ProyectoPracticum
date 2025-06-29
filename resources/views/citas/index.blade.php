@extends('layouts.master')

@section('title', 'Citas Médicas')

@section('content')
<div class="container mt-4">

    {{-- Encabezado de página y botón de acción --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Citas Médicas</h1>
        <a href="{{ route('citas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear nueva cita
        </a>
    </div>

    {{-- Barra de búsqueda para filtrar citas --}}
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar citas por paciente, médico, fecha...">
    </div>

    {{-- Tabla responsiva --}}
    <div class="table-responsive">
        <table class="table table-hover align-middle" id="citasTable" data-sort-dir="asc">
            <thead class="table-dark">
                <tr>
                    {{-- Encabezados ordenables --}}
                    <th scope="col" style="cursor:pointer" onclick="sortTable(0)">Paciente <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(1)">Médico <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col" style="cursor:pointer" onclick="sortTable(2)">Fecha <i class="bi bi-arrow-down-up"></i></th>
                    <th scope="col">Hora</th>
                    <th scope="col">Tipo de Cita</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Mostrar cada cita --}}
                @forelse ($cita as $cita)
                <tr>
                    <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                    <td>{{ $cita->medico->nombre }} {{ $cita->medico->apellido }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}</td>
                    <td>{{ $cita->tipo_cita }}</td>
                    <td>
                        @if($cita->estado == 'Confirmada')
                            <span class="badge bg-success">{{ $cita->estado }}</span>
                        @elseif($cita->estado == 'Pendiente')
                            <span class="badge bg-warning text-dark">{{ $cita->estado }}</span>
                        @elseif($cita->estado == 'Atendida')
                            <span class="badge bg-primary">{{ $cita->estado }}</span>
                        @elseif($cita->estado == 'Cancelada')
                            <span class="badge bg-danger">{{ $cita->estado }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $cita->estado }}</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $user = Auth::user();
                            $puedeEditar = true;
                            $puedeEliminar = true;

                            // Paciente solo puede editar si estado es Pendiente
                            if ($user->role === 'paciente' && $cita->estado !== 'Pendiente') {
                                $puedeEditar = false;
                            }

                            // No se puede eliminar si estado es Atendida
                            if ($cita->estado === 'Atendida') {
                                $puedeEliminar = false;
                            }
                        @endphp

                        {{-- Botón: Ver --}}
                        <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-info btn-sm" title="Ver">
                            <i class="bi bi-eye"></i>
                        </a>

                        {{-- Botón: Editar --}}
                        @if ($puedeEditar)
                        <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        @endif

                        {{-- Botón para historial solo para médico --}}
                        @if ($user->role === 'medico')
                            @if ($cita->id_historial)
                                {{-- Editar historial --}}
                                <a href="{{ route('historial.edit', $cita->id_historial) }}" class="btn btn-sm btn-outline-primary" title="Editar Historial">
                                    <i class="bi bi-journal-text"></i>
                                </a>
                            @else
                                @if ($cita->estado === 'Confirmada')
                                    {{-- Crear historial --}}
                                    <a href="{{ route('historial.create', ['cita_id' => $cita->id]) }}" class="btn btn-sm btn-outline-success" title="Crear Historial">
                                        <i class="bi bi-journal-plus"></i>
                                    </a>
                                @endif
                            @endif
                        @endif

                        {{-- Botón: Eliminar con modal --}}
                        @if ($puedeEliminar)
                        <button
                            type="button"
                            class="btn btn-danger btn-sm"
                            title="Eliminar"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal"
                            data-citaid="{{ $cita->id }}"
                        >
                            <i class="bi bi-trash"></i>
                        </button>
                        @endif

                    </td>
                </tr>
                @empty
                {{-- Mensaje si no hay citas --}}
                <tr>
                    <td colspan="7" class="text-center">No hay citas registradas.</td>
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
          ¿Está seguro que desea eliminar esta cita médica?
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
    // Búsqueda en tabla
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#citasTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Ordenar tabla
    function sortTable(colIndex) {
        const table = document.getElementById('citasTable');
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);
        const asc = table.getAttribute('data-sort-dir') !== 'asc';

        rows.sort((a, b) => {
            let aText = a.cells[colIndex].textContent.trim();
            let bText = b.cells[colIndex].textContent.trim();

            if (colIndex === 2) { // Fecha
                aText = new Date(aText.split('/').reverse().join('-'));
                bText = new Date(bText.split('/').reverse().join('-'));
            }

            return (aText > bText ? 1 : -1) * (asc ? 1 : -1);
        });

        rows.forEach(row => tbody.appendChild(row));
        table.setAttribute('data-sort-dir', asc ? 'asc' : 'desc');
    }

    // Modal eliminar
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var citaId = button.getAttribute('data-citaid');
        var form = document.getElementById('deleteForm');
        form.action = '/citas/' + citaId;
    });
</script>
@endsection
