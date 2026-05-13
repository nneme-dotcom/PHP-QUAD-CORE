@extends('layouts.app')
@section('title', $incidencia->localizador)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Incidencia <code>{{ $incidencia->localizador }}</code></h4>
    <a href="{{ route('cliente.incidencias.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>
<div class="card border-0 shadow-sm p-4" style="max-width:600px">
    <dl class="row">
        <dt class="col-5">Especialidad</dt>
        <dd class="col-7">{{ $incidencia->especialidad->nombre_especialidad }}</dd>
        <dt class="col-5">Dirección</dt>
        <dd class="col-7">{{ $incidencia->direccion }}</dd>
        <dt class="col-5">Teléfono</dt>
        <dd class="col-7">{{ $incidencia->telefono_contacto }}</dd>
        <dt class="col-5">Fecha</dt>
        <dd class="col-7">{{ \Carbon\Carbon::parse($incidencia->fecha_servicio)->format('d/m/Y') }} ({{ $incidencia->franja_horaria }})</dd>
        <dt class="col-5">Urgencia</dt>
        <dd class="col-7">{{ $incidencia->tipo_urgencia }}</dd>
        <dt class="col-5">Estado</dt>
        <dd class="col-7">
            <span class="badge bg-{{
                $incidencia->estado === 'Pendiente'  ? 'warning text-dark' :
                ($incidencia->estado === 'Asignada'  ? 'primary' :
                ($incidencia->estado === 'Finalizada'? 'success' : 'secondary'))
            }}">{{ $incidencia->estado }}</span>
        </dd>
        <dt class="col-5">Técnico asignado</dt>
        <dd class="col-7">{{ $incidencia->tecnico->nombre_completo ?? '— Pendiente de asignación —' }}</dd>
        <dt class="col-5">Descripción</dt>
        <dd class="col-7">{{ $incidencia->descripcion }}</dd>
    </dl>
</div>
@endsection
