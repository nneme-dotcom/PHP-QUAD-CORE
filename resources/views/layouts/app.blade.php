<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaYa – @yield('title', 'Panel')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand:       #e74c3c;
            --brand-light: #fff0ef;
            --brand-dark:  #c0392b;
            --sidebar-w:   220px;
            --nav-h:       56px;
        }

        body {
            background-color: #f4f5f7;
            font-family: 'DM Sans', sans-serif;
            font-size: .9rem;
        }

        /* ── Navbar ── */
        .navbar { height: var(--nav-h); }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--brand) !important;
            letter-spacing: -.3px;
        }

        /* ── Sidebar ── */
        .sidebar {
            min-height: calc(100vh - var(--nav-h));
            background: #fff;
            border-right: 1px solid #e9ecef;
            width: var(--sidebar-w);
        }
        .sidebar .nav-link {
            color: #5a6474;
            border-radius: 7px;
            padding: .45rem .75rem;
            transition: background .15s, color .15s;
            font-size: .85rem;
        }
        .sidebar .nav-link:hover {
            color: var(--brand);
            background: var(--brand-light);
        }
        .sidebar .nav-link.active {
            color: var(--brand);
            background: var(--brand-light);
            font-weight: 600;
            border-left: 3px solid var(--brand);
            padding-left: calc(.75rem - 3px);
        }
        .sidebar .nav-link i { margin-right: 7px; width: 16px; }
        .sidebar-section {
            font-size: .68rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #adb5bd;
            padding: .5rem .75rem .25rem;
        }

        /* ── Offcanvas (móvil) ── */
        .offcanvas-sidebar .nav-link { color: #5a6474; padding: .45rem .75rem; border-radius: 7px; font-size: .85rem; }
        .offcanvas-sidebar .nav-link:hover, .offcanvas-sidebar .nav-link.active {
            color: var(--brand); background: var(--brand-light);
        }
        .offcanvas-sidebar .nav-link.active { font-weight: 600; }

        /* ── Cards ── */
        .card { border-radius: 10px; }

        /* ── Tables ── */
        .table thead th { font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; color: #6c757d; }
        .table td { vertical-align: middle; }

        /* ── Botones ── */
        .btn-danger { background-color: var(--brand); border-color: var(--brand); }
        .btn-danger:hover { background-color: var(--brand-dark); border-color: var(--brand-dark); }

        /* ── Código localizador ── */
        code { color: var(--brand); background: var(--brand-light); padding: .1rem .4rem; border-radius: 4px; font-family: 'DM Mono', monospace; font-size: .82rem; }

        /* ── Badge rol ── */
        .badge-rol { font-size: .65rem; letter-spacing: .03em; }

        /* ── Alertas flash ── */
        .alert { border-radius: 8px; font-size: .875rem; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        {{-- Hamburguesa visible solo en móvil --}}
        <button class="btn btn-outline-secondary btn-sm d-md-none me-2"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#sidebarOffcanvas"
                aria-controls="sidebarOffcanvas">
            <i class="bi bi-list"></i>
        </button>
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none"></a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-muted small d-none d-sm-inline">
                {{ session('user_name') }}
                <span class="badge bg-secondary badge-rol">{{ session('user_rol') }}</span>
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> <span class="d-none d-sm-inline">Salir</span>
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- Offcanvas sidebar para móvil --}}
<div class="offcanvas offcanvas-start offcanvas-sidebar" tabindex="-1" id="sidebarOffcanvas" style="max-width:260px">
    <div class="offcanvas-header border-bottom">
        <img src="{{ asset('logo.png') }}" alt="ReparaYa" style="height:36px;width:auto;">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-2">
        @include('partials.sidebar_nav')
    </div>
</div>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar desktop (oculto en móvil) --}}
        <nav class="col-md-2 sidebar py-3 d-none d-md-block">
            <div class="text-center py-3 px-2 mb-1">
                <img src="{{ asset('logo.png') }}" alt="ReparaYa" style="width:100%;height:auto;display:block;">
            </div>
            @include('partials.sidebar_nav')
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
