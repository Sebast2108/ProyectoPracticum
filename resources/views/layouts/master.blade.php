<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Hospital Isidro Ayora')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <div class="container-fluid">
        <div class="row">

            {{-- Barra Lateral --}}
            <nav class="col-md-3 col-lg-2 d-md-block bg-primary sidebar collapse min-vh-100">
                <div class="position-sticky pt-3 text-white">
                    <div class="p-3">
                        <h5><i class="bi bi-hospital"></i> Hospital Isidro Ayora</h5>
                    </div>

                    <ul class="nav flex-column">

                        @guest
                            {{-- Opciones para usuarios no autenticados --}}
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('home') }}"><i class="bi bi-house-door"></i> Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                            </li>
                        @endguest

                        @auth
                            {{-- Inicio común para todos los usuarios autenticados --}}
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('home') }}"><i class="bi bi-house"></i> Inicio</a>
                            </li>

                            {{-- Recuperación del rol del usuario --}}
                            @php $role = Auth::user()->role; @endphp

                            {{-- Menú específico según el rol del usuario --}}
                            @if($role === 'paciente')
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('citas.index') }}"><i class="bi bi-calendar-heart"></i> Citas Médicas</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('historial.index') }}"><i class="bi bi-folder"></i> Historial Médico</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('paciente.index') }}"><i class="bi bi-person-fill"></i> Pacientes</a></li>
                            @endif

                            @if($role === 'secretaria')
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('citas.index') }}"><i class="bi bi-calendar-check"></i> Citas Médicas</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('paciente.index') }}"><i class="bi bi-person"></i> Pacientes</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('medico.index') }}"><i class="bi bi-person-badge"></i> Médicos</a></li>
                            @endif

                            @if($role === 'medico')
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('paciente.index') }}"><i class="bi bi-people"></i> Pacientes</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('citas.index') }}"><i class="bi bi-calendar-week"></i> Citas Médicas</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('historial.index') }}"><i class="bi bi-folder"></i> Historial Médico</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('agenda.index') }}"><i class="bi bi-journal-medical"></i> Agenda</a></li>
                            @endif

                            @if($role === 'gerente')
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('estadisticas.index') }}"><i class="bi bi-bar-chart-line"></i> Estadísticas</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('reporte.index') }}"><i class="bi bi-file-earmark-bar-graph"></i> Reportes</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="bi bi-calendar-week"></i> Dashboard</a></li>
                            @endif

                            @if($role === 'administrador')
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('paciente.index') }}"><i class="bi bi-person-fill"></i> Pacientes</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('medico.index') }}"><i class="bi bi-person-badge-fill"></i> Médicos</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('especialidad.index') }}"><i class="bi bi-person-badge-fill"></i> Especialidad</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('secretaria.index') }}"><i class="bi bi-person-workspace"></i> Secretaria</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('gerente.index') }}"><i class="bi bi-people-fill"></i> Gerentes</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('estadisticas.index') }}"><i class="bi bi-bar-chart"></i> Estadísticas</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('reporte.index') }}"><i class="bi bi-graph-up-arrow"></i> Reportes</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('administrador.index') }}"><i class="bi bi-gear-fill"></i> Administradores</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('users.index') }}"><i class="bi bi-person-fill"></i> Usuarios</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('citas.index') }}"><i class="bi bi-calendar-week"></i> Citas Médicas</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('historial.index') }}"><i class="bi bi-folder"></i> Historial Médico</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('agenda.index') }}"><i class="bi bi-journal-medical"></i> Agenda</a></li>
                                <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard.index') }}"><i class="bi bi-calendar-week"></i> Dashboard</a></li>
                            @endif
                        @endauth

                    </ul>
                </div>
            </nav>

            {{-- Contenido Principal --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                {{-- Barra superior con nombre y botón de logout --}}
                @auth
                    <div class="d-flex justify-content-end align-items-center py-2 border-bottom">
                        <span class="me-3"><i class="bi bi-person-circle fs-5"></i> {{ ucfirst(Auth::user()->role) }} - {{ Auth::user()->name }}</span>
                        <a class="btn btn-sm btn-outline-danger" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </a>
                        {{-- Formulario oculto para cerrar sesión --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                @endauth

                <div class="py-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    {{-- Pie de Pagina --}}
    <footer class="bg-light text-center text-muted py-3 mt-4 shadow-sm">
        &copy; {{ date('Y') }} Hospital Isidro Ayora. Todos los derechos reservados.
    </footer>

    {{-- Scripts de Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 