@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

<div class="mb-4">
    <h5 class="fw-600 mb-0">Hola, {{ session('user_name') }} 👋</h5>
    <small class="text-muted">Panel de control · ReparaYa</small>
</div>

@if(session('user_rol') === 'admin')
    <div class="row g-3 mb-4">
        @php
            $stats_config = [
                ['key' => 'incidencias', 'label' => 'Incidencias',  'icon' => 'bi-clipboard-check', 'color' => '#e74c3c', 'bg' => '#fff0ef'],
                ['key' => 'tecnicos',    'label' => 'Técnicos',     'icon' => 'bi-person-badge',    'color' => '#3b82f6', 'bg' => '#eff6ff'],
                ['key' => 'usuarios',    'label' => 'Usuarios',     'icon' => 'bi-people',          'color' => '#10b981', 'bg' => '#ecfdf5'],
                ['key' => 'gestoras',    'label' => 'Gestoras',     'icon' => 'bi-building',        'color' => '#f59e0b', 'bg' => '#fffbeb'],
            ];
        @endphp
        @foreach($stats_config as $s)
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm p-3 d-flex flex-row align-items-center gap-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center"
                     style="width:44px;height:44px;background:{{ $s['bg'] }};flex-shrink:0">
                    <i class="bi {{ $s['icon'] }}" style="color:{{ $s['color'] }};font-size:1.2rem"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5 lh-1">{{ $stats[$s['key']] }}</div>
                    <div class="text-muted" style="font-size:.78rem">{{ $s['label'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3">
                <p class="text-muted small mb-2 fw-600">Accesos rápidos</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.incidencias.index') }}" class="btn btn-sm btn-danger"><i class="bi bi-clipboard-check me-1"></i>Incidencias</a>
                    <a href="{{ route('admin.gestoras.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-building me-1"></i>Gestoras</a>
                    <a href="{{ route('admin.liquidaciones.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-cash-coin me-1"></i>Liquidaciones</a>
                </div>
            </div>
        </div>
    </div>

@elseif(session('user_rol') === 'particular')
    <div class="card border-0 shadow-sm p-4" style="max-width:480px">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#fff0ef;flex-shrink:0">
                <i class="bi bi-clipboard-plus" style="color:#e74c3c;font-size:1.3rem"></i>
            </div>
            <div>
                <div class="fw-600">Mis Incidencias</div>
                <div class="text-muted small">Consulta y gestiona tus avisos</div>
            </div>
        </div>
        <a href="{{ route('cliente.incidencias.index') }}" class="btn btn-danger btn-sm">Ver incidencias <i class="bi bi-arrow-right ms-1"></i></a>
    </div>

@elseif(session('user_rol') === 'tecnico')
    <div class="card border-0 shadow-sm p-4" style="max-width:480px">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:48px;height:48px;background:#eff6ff;flex-shrink:0">
                <i class="bi bi-person-badge" style="color:#3b82f6;font-size:1.3rem"></i>
            </div>
            <div>
                <div class="fw-600">Mis Servicios</div>
                <div class="text-muted small">Servicios que tienes asignados</div>
            </div>
        </div>
        <a href="{{ route('tecnico.incidencias.index') }}" class="btn btn-sm btn-primary">Ver servicios <i class="bi bi-arrow-right ms-1"></i></a>
    </div>

@elseif(session('user_rol') === 'gestora')
    <div class="row g-3" style="max-width:640px">
        <div class="col-sm-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width:44px;height:44px;background:#fff0ef">
                    <i class="bi bi-clipboard-plus" style="color:#e74c3c;font-size:1.2rem"></i>
                </div>
                <div class="fw-600 mb-1">Avisos</div>
                <div class="text-muted small mb-3">Crea y consulta los avisos de tus comunidades</div>
                <a href="{{ route('gestora.incidencias.index') }}" class="btn btn-danger btn-sm mt-auto">Ir a avisos <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="rounded-3 d-flex align-items-center justify-content-center mb-3" style="width:44px;height:44px;background:#fffbeb">
                    <i class="bi bi-cash-coin" style="color:#f59e0b;font-size:1.2rem"></i>
                </div>
                <div class="fw-600 mb-1">Comisiones</div>
                <div class="text-muted small mb-3">Revisa tus comisiones acumuladas mes a mes</div>
                <a href="{{ route('gestora.comisiones.index') }}" class="btn btn-outline-secondary btn-sm mt-auto">Ver comisiones <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
@endif
@endsection
