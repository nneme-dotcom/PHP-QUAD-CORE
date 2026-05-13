@extends('layouts.app')
@section('title', 'Mis Avisos')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-clipboard-plus"></i> Avisos de {{ $gestora->nombre }}</h4>
    <a href="{{ route('gestora.incidencias.create') }}" class="btn btn-danger btn-sm">
        <i class="bi bi-plus-lg"></i> Nuevo aviso
    </a>
</div>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr><th>Localizador</th><th>Especialidad</th><th>Dirección</th><th>Fecha</th><th>Estado</th><th></th></tr>
        </thead>
        <tbody>
        @forelse($incidencias as $i)
            <tr>
                <td><code>{{ $i->localizador }}</code></td>
                <td>{{ $i->especialidad->nombre_especialidad ?? '—' }}</td>
                <td>{{ $i->direccion }}</td>
                <td>{{ \Carbon\Carbon::parse($i->fecha_servicio)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge bg-{{
                        $i->estado === 'Pendiente'  ? 'warning text-dark' :
                        ($i->estado === 'Asignada'  ? 'primary' :
                        ($i->estado === 'Finalizada'? 'success' : 'secondary'))
                    }}">{{ $i->estado }}</span>
                </td>
                <td>
                    <a href="{{ route('gestora.incidencias.show', $i) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Sin avisos creados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
