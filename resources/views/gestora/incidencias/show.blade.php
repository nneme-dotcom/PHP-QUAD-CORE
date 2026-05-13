@extends('layouts.app')
@section('title', $incidencia->localizador)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Aviso <code>{{ $incidencia->localizador }}</code></h4>
    <a href="{{ route('gestora.incidencias.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>
<div class="row g-3">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm p-4">
            <dl class="row mb-0">
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
                <dt class="col-5">Técnico</dt>
                <dd class="col-7">{{ $incidencia->tecnico->nombre_completo ?? '— Pendiente —' }}</dd>
                <dt class="col-5">Descripción</dt>
                <dd class="col-7">{{ $incidencia->descripcion }}</dd>
            </dl>
        </div>
    </div>
    @if($incidencia->comision)
    <div class="col-md-5">
        <div class="card border-0 shadow-sm p-4 border-start border-danger border-3">
            <h6 class="text-muted mb-3"><i class="bi bi-cash-coin"></i> Comisión</h6>
            <dl class="row mb-0">
                <dt class="col-7">Importe base</dt>
                <dd class="col-5">{{ number_format($incidencia->comision->importe_base, 2) }}€</dd>
                <dt class="col-7">% Comisión</dt>
                <dd class="col-5">{{ $incidencia->comision->porcentaje }}%</dd>
                <dt class="col-7">Comisión generada</dt>
                <dd class="col-5"><strong class="text-danger">{{ number_format($incidencia->comision->importe_comision, 2) }}€</strong></dd>
                <dt class="col-7">Mes/Año</dt>
                <dd class="col-5">{{ $incidencia->comision->mes }}/{{ $incidencia->comision->anio }}</dd>
            </dl>
        </div>
    </div>
    @endif
</div>
@endsection
