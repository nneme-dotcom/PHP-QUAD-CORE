<ul class="nav flex-column gap-1 px-2 py-2">

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i> Inicio
        </a>
    </li>

    {{-- Sección de Administración (Ahora visible para todos para el vídeo) --}}
    <li class="sidebar-section mt-2">Administración</li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}" href="{{ route('admin.usuarios.index') }}">
            <i class="bi bi-people"></i> Usuarios
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.tecnicos.*') ? 'active' : '' }}" href="{{ route('admin.tecnicos.index') }}">
            <i class="bi bi-person-badge"></i> Técnicos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.especialidades.*') ? 'active' : '' }}" href="{{ route('admin.especialidades.index') }}">
            <i class="bi bi-wrench-adjustable"></i> Especialidades
        </a>
    </li>

    <li class="sidebar-section mt-2">Operaciones</li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.incidencias.*') ? 'active' : '' }}" href="{{ route('admin.incidencias.index') }}">
            <i class="bi bi-clipboard-check"></i> Incidencias
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.gestoras.*') ? 'active' : '' }}" href="{{ route('admin.gestoras.index') }}">
            <i class="bi bi-building"></i> Gestoras
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.liquidaciones.*') ? 'active' : '' }}" href="{{ route('admin.liquidaciones.index') }}">
            <i class="bi bi-cash-coin"></i> Liquidaciones
        </a>
    </li>

    {{-- Secciones de Cliente/Gestora --}}
    <li class="sidebar-section mt-2">Accesos Directos</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cliente.incidencias.index') }}">
            <i class="bi bi-clipboard-plus"></i> Mis Avisos (Cliente)
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('gestora.comisiones.index') }}">
            <i class="bi bi-briefcase"></i> Mis Comisiones (Gestora)
        </a>
    </li>

</ul>