<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaYa – @yield('title', 'Panel')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; color: #e74c3c !important; }
        .sidebar { min-height: calc(100vh - 56px); background: #fff; border-right: 1px solid #dee2e6; }
        .sidebar .nav-link { color: #495057; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #e74c3c; background: #fff5f5; border-radius: 6px; }
        .sidebar .nav-link i { margin-right: 8px; }
        .badge-rol { font-size: 0.7rem; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="bi bi-tools"></i> ReparaYa
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-muted small">
                {{ session('user_name') }}
                <span class="badge bg-secondary badge-rol">{{ session('user_rol') }}</span>
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Salir
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <nav class="col-md-2 sidebar py-3">
            <ul class="nav flex-column gap-1">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Inicio
                    </a>
                </li>

                @if(session('user_rol') === 'admin')
                    <li class="nav-item mt-2">
                        <small class="text-muted px-3 text-uppercase fw-bold" style="font-size:.7rem">Administración</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}"
                           href="{{ route('admin.usuarios.index') }}">
                            <i class="bi bi-people"></i> Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.tecnicos.*') ? 'active' : '' }}"
                           href="{{ route('admin.tecnicos.index') }}">
                            <i class="bi bi-person-badge"></i> Técnicos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.especialidades.*') ? 'active' : '' }}"
                           href="{{ route('admin.especialidades.index') }}">
                            <i class="bi bi-wrench-adjustable"></i> Especialidades
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.incidencias.*') ? 'active' : '' }}"
                           href="{{ route('admin.incidencias.index') }}">
                            <i class="bi bi-clipboard-check"></i> Incidencias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.gestoras.*') ? 'active' : '' }}"
                           href="{{ route('admin.gestoras.index') }}">
                            <i class="bi bi-building"></i> Gestoras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.liquidaciones.*') ? 'active' : '' }}"
                           href="{{ route('admin.liquidaciones.index') }}">
                            <i class="bi bi-cash-coin"></i> Liquidaciones
                        </a>
                    </li>
                @endif

                @if(session('user_rol') === 'tecnico')
                    <li class="nav-item mt-2">
                        <small class="text-muted px-3 text-uppercase fw-bold" style="font-size:.7rem">Mis servicios</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tecnico.incidencias.*') ? 'active' : '' }}"
                           href="{{ route('tecnico.incidencias.index') }}">
                            <i class="bi bi-clipboard-check"></i> Mis Incidencias
                        </a>
                    </li>
                @endif

                @if(session('user_rol') === 'particular')
                    <li class="nav-item mt-2">
                        <small class="text-muted px-3 text-uppercase fw-bold" style="font-size:.7rem">Mis avisos</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cliente.incidencias.*') ? 'active' : '' }}"
                           href="{{ route('cliente.incidencias.index') }}">
                            <i class="bi bi-clipboard-plus"></i> Mis Incidencias
                        </a>
                    </li>
                @endif

                @if(session('user_rol') === 'gestora')
                    <li class="nav-item mt-2">
                        <small class="text-muted px-3 text-uppercase fw-bold" style="font-size:.7rem">Panel Gestora</small>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gestora.incidencias.*') ? 'active' : '' }}"
                           href="{{ route('gestora.incidencias.index') }}">
                            <i class="bi bi-clipboard-plus"></i> Avisos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gestora.comisiones.*') ? 'active' : '' }}"
                           href="{{ route('gestora.comisiones.index') }}">
                            <i class="bi bi-cash-coin"></i> Comisiones
                        </a>
                    </li>
                @endif

            </ul>
        </nav>

        {{-- Contenido principal --}}
        <main class="col-md-10 py-4 px-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
