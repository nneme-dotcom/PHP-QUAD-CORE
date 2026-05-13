@extends('layouts.app')
@section('title', 'Mis Servicios')
@section('content')
<h4 class="mb-3"><i class="bi bi-clipboard-check"></i> Mis Servicios Asignados</h4>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr><th>Localizador</th><th>Cliente</th><th>Especialidad</th><th>Fecha</th><th>Estado</th><th></th></tr>
        </thead>
        <tbody>
        @forelse($incidencias as $i)
            <tr>
                <td><code>{{ $i->localizador }}</code></td>
                <td>{{ $i->cliente->nombre ?? '—' }}</td>
                <td>{{ $i->especialidad->nombre_especialidad ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($i->fecha_servicio)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge bg-{{ $i->estado === 'Finalizada' ? 'success' : 'primary' }}">
                        {{ $i->estado }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('tecnico.incidencias.show', $i) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">No tienes servicios asignados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
