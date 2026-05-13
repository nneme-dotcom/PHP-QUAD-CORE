@extends('layouts.app')
@section('title', 'Mis Comisiones')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-cash-coin"></i> Comisiones — {{ $gestora->nombre }}</h4>
    <span class="badge bg-danger fs-6">Total acumulado: {{ number_format($totalAcumulado, 2) }}€</span>
</div>

@forelse($resumen as $key => $mes)
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-white d-flex justify-content-between">
            <strong>{{ $mes['mes'] }}/{{ $mes['anio'] }}</strong>
            <span>{{ $mes['servicios'] }} servicios — <strong>{{ number_format($mes['total'], 2) }}€</strong></span>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0 small">
                <thead class="table-light">
                    <tr><th>Localizador</th><th>Especialidad</th><th>Base</th><th>%</th><th>Comisión</th></tr>
                </thead>
                <tbody>
                @foreach($mes['detalle'] as $c)
                    <tr>
                        <td><code>{{ $c->incidencia->localizador ?? '—' }}</code></td>
                        <td>{{ $c->incidencia->especialidad->nombre_especialidad ?? '—' }}</td>
                        <td>{{ number_format($c->importe_base, 2) }}€</td>
                        <td>{{ $c->porcentaje }}%</td>
                        <td><strong>{{ number_format($c->importe_comision, 2) }}€</strong></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@empty
    <div class="alert alert-info">Todavía no tienes comisiones registradas.</div>
@endforelse
@endsection
