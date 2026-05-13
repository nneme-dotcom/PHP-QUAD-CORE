@extends('layouts.app')
@section('title', $gestora->nombre)
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-building"></i> {{ $gestora->nombre }}</h4>
    <a href="{{ route('admin.gestoras.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>
<div class="row g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <h6 class="text-muted">Datos</h6>
            <dl class="row mb-0 small">
                <dt class="col-5">CIF</dt><dd class="col-7">{{ $gestora->cif }}</dd>
                <dt class="col-5">Email</dt><dd class="col-7">{{ $gestora->email }}</dd>
                <dt class="col-5">Teléfono</dt><dd class="col-7">{{ $gestora->telefono ?? '—' }}</dd>
                <dt class="col-5">Comisión</dt><dd class="col-7"><strong>{{ $gestora->porcentaje_comision }}%</strong></dd>
                <dt class="col-5">Usuario</dt><dd class="col-7">{{ $gestora->usuario->email ?? '—' }}</dd>
            </dl>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-3">
            <h6 class="text-muted mb-3">Servicios tramitados</h6>
            @forelse($gestora->incidencias as $i)
                <div class="d-flex justify-content-between border-bottom py-2 small">
                    <span><code>{{ $i->localizador }}</code> — {{ $i->especialidad->nombre_especialidad ?? '' }}</span>
                    <span class="badge bg-{{ $i->estado === 'Finalizada' ? 'success' : 'secondary' }}">{{ $i->estado }}</span>
                </div>
            @empty
                <p class="text-muted small">Sin servicios.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
