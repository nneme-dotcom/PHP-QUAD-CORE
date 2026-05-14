@extends('layouts.app')
@section('title', 'Incidencia ' . $incidencia->localizador)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><code>{{ $incidencia->localizador }}</code></h4>
    <a href="{{ route('admin.incidencias.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="row g-3">
    {{-- Datos --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-3">
            <h6 class="text-muted mb-3">Datos del servicio</h6>
            <dl class="row mb-0">
                <dt class="col-5">Cliente</dt>
                <dd class="col-7">{{ $incidencia->cliente->nombre }} {{ $incidencia->cliente->apellidos }}</dd>
                <dt class="col-5">Especialidad</dt>
                <dd class="col-7">{{ $incidencia->especialidad->nombre_especialidad }}</dd>
                <dt class="col-5">Dirección</dt>
                <dd class="col-7">{{ $incidencia->direccion }}</dd>
                <dt class="col-5">Teléfono</dt>
                <dd class="col-7">{{ $incidencia->telefono_contacto }}</dd>
                <dt class="col-5">Fecha</dt>
                <dd class="col-7">{{ \Carbon\Carbon::parse($incidencia->fecha_servicio)->format('d/m/Y H:i') }}</dd>
                <dt class="col-5">Franja</dt>
                <dd class="col-7">{{ ucfirst($incidencia->franja_horaria) }}</dd>
                <dt class="col-5">Urgencia</dt>
                <dd class="col-7">{{ $incidencia->tipo_urgencia }}</dd>
                <dt class="col-5">Estado</dt>
                <dd class="col-7">@include('partials.badge_estado', ['estado' => $incidencia->estado])</dd>
                <dt class="col-5">Descripción</dt>
                <dd class="col-7">{{ $incidencia->descripcion }}</dd>
            </dl>
        </div>
    </div>

    {{-- Acciones --}}
    <div class="col-md-6">
        {{-- Asignar técnico --}}
        <div class="card border-0 shadow-sm p-3 mb-3">
            <h6 class="text-muted mb-3">Asignar técnico</h6>
            <p class="small">Técnico actual: <strong>{{ $incidencia->tecnico->nombre_completo ?? '— Sin asignar —' }}</strong></p>
            <form method="POST" action="{{ route('admin.incidencias.asignar', $incidencia) }}">
                @csrf
                <div class="input-group">
                    <select name="tecnico_id" class="form-select">
                        <option value="">— Sin técnico —</option>
                        @foreach($tecnicos as $t)
                            <option value="{{ $t->id }}" {{ $incidencia->tecnico_id == $t->id ? 'selected' : '' }}>
                                {{ $t->nombre_completo }} ({{ $t->especialidad->nombre_especialidad ?? '' }})
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">Asignar</button>
                </div>
            </form>
        </div>

        {{-- Cambiar estado --}}
        <div class="card border-0 shadow-sm p-3">
            <h6 class="text-muted mb-3">Cambiar estado</h6>
            <form method="POST" action="{{ route('admin.incidencias.estado', $incidencia) }}">
                @csrf
                <div class="input-group">
                    <select name="estado" class="form-select">
                        @foreach(['Pendiente','Asignada','Finalizada','Cancelada'] as $est)
                            <option value="{{ $est }}" {{ $incidencia->estado === $est ? 'selected' : '' }}>
                                {{ $est }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
