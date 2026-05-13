@extends('layouts.app')
@section('title', $incidencia->localizador)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Servicio <code>{{ $incidencia->localizador }}</code></h4>
    <a href="{{ route('tecnico.incidencias.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>
<div class="row g-3">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm p-4">
            <dl class="row mb-0">
                <dt class="col-5">Cliente</dt>
                <dd class="col-7">{{ $incidencia->cliente->nombre }} — {{ $incidencia->cliente->telefono ?? '' }}</dd>
                <dt class="col-5">Especialidad</dt>
                <dd class="col-7">{{ $incidencia->especialidad->nombre_especialidad }}</dd>
                <dt class="col-5">Dirección</dt>
                <dd class="col-7">{{ $incidencia->direccion }}</dd>
                <dt class="col-5">Teléfono contacto</dt>
                <dd class="col-7">{{ $incidencia->telefono_contacto }}</dd>
                <dt class="col-5">Fecha</dt>
                <dd class="col-7">{{ \Carbon\Carbon::parse($incidencia->fecha_servicio)->format('d/m/Y') }} ({{ $incidencia->franja_horaria }})</dd>
                <dt class="col-5">Urgencia</dt>
                <dd class="col-7">{{ $incidencia->tipo_urgencia }}</dd>
                <dt class="col-5">Descripción</dt>
                <dd class="col-7">{{ $incidencia->descripcion }}</dd>
            </dl>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-3">
            <h6 class="text-muted mb-3">Actualizar estado</h6>
            <p>Estado actual: <span class="badge bg-primary">{{ $incidencia->estado }}</span></p>
            <form method="POST" action="{{ route('tecnico.incidencias.estado', $incidencia) }}">
                @csrf
                <div class="input-group">
                    <select name="estado" class="form-select">
                        <option value="Asignada"   {{ $incidencia->estado === 'Asignada'   ? 'selected' : '' }}>Asignada</option>
                        <option value="Finalizada" {{ $incidencia->estado === 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                    </select>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
