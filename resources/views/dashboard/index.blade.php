@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<h4 class="mb-4">Bienvenido, {{ session('user_name') }}</h4>

@if(session('user_rol') === 'admin')
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-clipboard-check fs-2 text-danger"></i>
                <div class="fs-4 fw-bold mt-2">{{ $stats['incidencias'] }}</div>
                <div class="text-muted small">Incidencias totales</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-person-badge fs-2 text-primary"></i>
                <div class="fs-4 fw-bold mt-2">{{ $stats['tecnicos'] }}</div>
                <div class="text-muted small">Técnicos</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-people fs-2 text-success"></i>
                <div class="fs-4 fw-bold mt-2">{{ $stats['usuarios'] }}</div>
                <div class="text-muted small">Usuarios</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-building fs-2 text-warning"></i>
                <div class="fs-4 fw-bold mt-2">{{ $stats['gestoras'] }}</div>
                <div class="text-muted small">Gestoras</div>
            </div>
        </div>
    </div>

@elseif(session('user_rol') === 'particular')
    <div class="card border-0 shadow-sm p-4">
        <p>Desde aquí puedes gestionar tus incidencias.</p>
        <a href="{{ route('cliente.incidencias.index') }}" class="btn btn-danger">
            <i class="bi bi-clipboard-plus"></i> Ver mis incidencias
        </a>
    </div>

@elseif(session('user_rol') === 'tecnico')
    <div class="card border-0 shadow-sm p-4">
        <p>Aquí puedes consultar los servicios que tienes asignados.</p>
        <a href="{{ route('tecnico.incidencias.index') }}" class="btn btn-primary">
            <i class="bi bi-clipboard-check"></i> Ver mis servicios
        </a>
    </div>

@elseif(session('user_rol') === 'gestora')
    <div class="card border-0 shadow-sm p-4">
        <p>Panel de gestión de comunidades. Crea avisos y consulta tus comisiones.</p>
        <div class="d-flex gap-2">
            <a href="{{ route('gestora.incidencias.index') }}" class="btn btn-danger">
                <i class="bi bi-clipboard-plus"></i> Mis avisos
            </a>
            <a href="{{ route('gestora.comisiones.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-cash-coin"></i> Comisiones
            </a>
        </div>
    </div>
@endif
@endsection
