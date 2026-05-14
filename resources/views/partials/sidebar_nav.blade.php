<ul class="nav flex-column gap-1 px-2 py-2">

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i> Inicio
        </a>
    </li>

    @if(session('user_rol') === 'admin')
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
    @endif

    @if(session('user_rol') === 'tecnico')
        <li class="sidebar-section mt-2">Mis servicios</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('tecnico.incidencias.*') ? 'active' : '' }}" href="{{ route('tecnico.incidencias.index') }}">
                <i class="bi bi-clipboard-check"></i> Incidencias
            </a>
        </li>
    @endif

    @if(session('user_rol') === 'particular')
        <li class="sidebar-section mt-2">Mis avisos</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cliente.incidencias.*') ? 'active' : '' }}" href="{{ route('cliente.incidencias.index') }}">
                <i class="bi bi-clipboard-plus"></i> Incidencias
            </a>
        </li>
    @endif

    @if(session('user_rol') === 'gestora')
        <li class="sidebar-section mt-2">Panel Gestora</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('gestora.incidencias.*') ? 'active' : '' }}" href="{{ route('gestora.incidencias.index') }}">
                <i class="bi bi-clipboard-plus"></i> Avisos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('gestora.comisiones.*') ? 'active' : '' }}" href="{{ route('gestora.comisiones.index') }}">
                <i class="bi bi-cash-coin"></i> Comisiones
            </a>
        </li>
    @endif

</ul>
