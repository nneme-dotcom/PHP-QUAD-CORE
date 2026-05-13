@extends('layouts.app')
@section('title', 'Liquidaciones')
@section('content')
<h4 class="mb-4"><i class="bi bi-cash-coin"></i> Liquidaciones a Gestoras</h4>

@forelse($liquidaciones as $liq)
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>{{ $liq['gestora']->nombre }}</strong>
            <span class="text-danger fw-bold">Total acumulado: {{ number_format($liq['total_acumulado'], 2) }}€</span>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead class="table-light">
                    <tr><th>Mes</th><th>Año</th><th>Servicios</th><th>Comisión total</th></tr>
                </thead>
                <tbody>
                @forelse($liq['por_mes'] as $mes)
                    <tr>
                        <td>{{ $mes['mes'] }}</td>
                        <td>{{ $mes['anio'] }}</td>
                        <td>{{ $mes['servicios'] }}</td>
                        <td><strong>{{ number_format($mes['total'], 2) }}€</strong></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted text-center">Sin comisiones.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@empty
    <div class="alert alert-info">No hay liquidaciones pendientes.</div>
@endforelse
@endsection
